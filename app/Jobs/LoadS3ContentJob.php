<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Gate;
use App\Section;
use App\User;
use App\Classes\ImageManager;
use App\Exceptions\NoSpaceLeftException;
use Illuminate\Support\Facades\Auth;

class LoadS3ContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $imageConfig;
    private $contentData;
    private $section;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Section $section, $contentData)
    {
      $this->user = $user;
      $this->imageConfig = config($contentData['content_type']);
      $this->imageConfig['directory'] = $contentData['directory'];
      $this->contentData = $contentData;
      $this->section = $section;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      // Auth::login($this->user);
      $imagesNumber = $this->contentData['number'];
      $counter = $this->section->images->where('s3_disk', $this->imageConfig['s3_folder'])->count() + 1;
      $imagesList = randomGen(0, $this->imageConfig['max_number'], $imagesNumber);
      $images = $solutions = [];
      $batchSize = 0;
      // $user = $this->section->book->user;
      foreach ($imagesList as $libraryImage) {
        $batchSize+= $this->imageConfig['size'];
        if (Gate::forUser($this->user)->denies('space-available', $batchSize)) {
          // $error = [
          //   'deny' => config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.code'),
          //   'message' => config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.message'),
          //   'images' => $images,
          //   'solutions' => $solutions,
          // ];
          // return $error;
          throw new NoSpaceLeftException($this->section->id);
        }

        $this->imageConfig['file_name'] = $libraryImage  . $this->imageConfig['ext'];
        $this->imageConfig['show_name'] = $this->imageConfig['puzzle_name'] . ' ' . $counter;
        $image = ImageManager::saveLibraryImage($this->section, $this->imageConfig);

        $images[] = $image;

        if (!empty($this->imageConfig['solutions_folder'])) {
          $this->imageConfig['show_name'] = $this->imageConfig['solution_name'] . ' ' . $counter;
          $solution = ImageManager::saveLibraryImage($this->section, $this->imageConfig, true);

          $solutions[] = $solution;
        }

        $counter++;
      }

      // return array('images' => $images, 'solutions' => $solutions);
    }
}
