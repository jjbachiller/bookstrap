<?php
namespace App\Classes;

use Illuminate\Support\Facades\Storage;

class ImageManager
{

  public static function saveLocalImage($section, $uploadedFile, $solution = false)
  {
    $image = new \App\Image;
    $image->solution = $solution;
    $section->content()->save($image);

    $imagePath = $image->path('original');

    Storage::makeDirectory($imagePath);

    $fileName = trim($uploadedFile->getClientOriginalName());

    $imageFilePath = $uploadedFile->storeAs($imagePath, $fileName);
    if($imageFilePath)
    {
      $imageFilePath = Storage::path($imageFilePath);
      $imageFile = new \SplFileInfo($imageFilePath);

      // Update the image data with the saved file info.
      $image->file_name = $imageFile->getBasename();
      $image->show_name = $imageFile->getBasename('.' . $imageFile->getExtension());
      $image->size = $imageFile->getSize();
      list($width, $height) = getimagesize($imageFile);
      $image->width = $width;
      $image->height = $height;
      $image->type = mime_content_type($imageFile->getPathname());
      $image->save();

      // Miniatures generation for the image
      $miniatures = config('bookstrap-constants.miniatures');
      foreach ($miniatures as $miniature) {
        if ($miniature['width'] == 0 || $miniature['height'] == 0) continue;
        makeThumbnails($imagePath, $image->file_name, $miniature);
      }

      return $image;
    }

    return false;
  }

  public static function saveSudokuImage($section, $imageConfig, $solution = false)
  {
    $image = new \App\Image;
    $image->s3_disk = $imageConfig['s3_folder'];
    $image->s3_directory = $imageConfig['directory'];
    $image->file_name = $imageConfig['file_name'];
    $image->show_name = $imageConfig['show_name'];
    $image->size = $imageConfig['size'];
    $image->width = $imageConfig['width'];
    $image->height = $imageConfig['height'];
    $image->type = $imageConfig['type'];
    $image->solution = $solution;
    $section->content()->save($image);

    self::saveS3ImageLocally($image);

    return $image;
  }

  public static function saveLibraryImages($contentData, $section, $config)
  {
    $imageConfig = $config;
    $imageConfig['directory'] = $contentData['directory'];
    $imagesNumber = $contentData['number'];

    $counter = $section->images->where('s3_disk', $config['s3_folder'])->count() + 1;
    $imagesList = randomGen(0, $config['max_number'], $imagesNumber);
    $images = $solutions = [];
    foreach ($imagesList as $libraryImage) {
      $imageConfig['file_name'] = $libraryImage  . $config['ext'];
      $imageConfig['show_name'] = $config['puzzle_name'] . ' ' . $counter;
      $image = self::saveSudokuImage($section, $imageConfig);

      $images[] = $image;

      if (!empty($config['solutions_folder'])) {
        $imageConfig['showName'] = $config['solution_name'] . ' ' . $counter;
        $solution = self::saveSudokuImage($section, $imageConfig, true);

        $solutions[] = $solution;
      }

      $counter++;
    }

    $response = array('images' => $images, 'solutions' => $solutions);

  }

  public static function saveS3ImageLocally($image)
  {

    $localImagePath = $image->path();

    Storage::makeDirectory($localImagePath);

    $localImagePath.= $image->file_name;

    if (!is_file($localImagePath)) {
      $s3ImagePath = $image->s3Path() . $image->file_name;

      Storage::put($localImagePath, Storage::disk('s3')->get($s3ImagePath));
    }
    return true;
  }

  public static function deleteImage($image)
  {
    if ($image->isLocal()) {
      self::deleteLocalImage($image);
      return false;
    }

    return self::deleteS3Image($image);
  }

  private static function deleteLocalImage($image)
  {
    $imagesSizes = config('bookstrap-constants.miniatures');
    foreach (array_keys($imagesSizes) as $size) {
      $sizePath = $image->path($size);
      $sizePath.= $image->file_name;
      Storage::delete($sizePath);
    }

    $image->delete();
  }

  private static function deleteS3Image($image)
  {
    // Find the complementary solution/image to delete it too.
    $solutionComplemented = !$image->solution;

    $solution = \App\Image::where('section_id', $image->section_id)
      ->where('s3_disk', $image->s3_disk)
      ->where('s3_directory', $image->s3_directory)
      ->where('file_name', $image->file_name)
      ->where('solution', $solutionComplemented)->first();

    $deletedSolutionId = false;
    if (!empty($solution)) {
      $deletedSolutionId = $solution->id;
      $solution->delete();
    }

    $image->delete();
    return ['deletedSolutionId' => $deletedSolutionId];
  }
}
