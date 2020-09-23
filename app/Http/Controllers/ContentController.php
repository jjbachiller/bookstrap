<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Classes\ImageManager;

class ContentController extends Controller
{

  public function getPreviewContent(Request $request)
  {
    $book = \App\Book::with(['sections.images', 'sections.solutions'])->findOrFail(session('idBook'));

    return $book;
  }

  public function getImage($size, $imageId)
  {
    $image = \App\Image::findOrFail($imageId);
    if ($image->section->book->user_id != Auth::user()->id)
    {
      abort(404);
    }

    $miniatures = config('bookstrap-constants.miniatures');
    if (!array_key_exists($size, $miniatures)) {
      abort(404);
    }

    $imagePath = $image->path($size) . $image->file_name;
    $file = Storage::path($imagePath);
    if (!is_file($file)) {
      if (!$image->isLocal()) {
        // If it's an s3 Image we try to readownload it
        if (!ImageManager::saveS3ImageLocally($image)) {
          abort(404);
        }
      }
      abort(404);
    }

    // return response()->file($file);


    $headers = array('Content-Type' => $image->type);
    //return the image file
    $response = response()->download($file,$image->show_name,$headers);
    ob_end_clean();
    return $response;
  }

  public function getPreviewImage($imageId)
  {
    return $this->getImage('preview', $imageId);
  }

  // private function getLocalImageFile($image, $size) {
  //
  //   $contentPath = config('bookstrap-constants.uploads_path') . $image->section->book->user->uid . '/' . $image->section->book->uid . '/' . $image->section->id . '/';
  //   if ($image->solution) {
  //     $contentPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
  //   }
  //
  //   $miniatures = config('bookstrap-constants.miniatures');
  //   if (!array_key_exists($size, $miniatures)) {
  //     abort(404);
  //   }
  //   $contentPath.= $miniatures[$size]['folder'];
  //
  //   $contentPath.= $image->file_name;
  //   $file = Storage::path($contentPath);
  //   if (!is_file($file)) {
  //     abort(404);
  //   }
  //   return response()->file($file);
  // }
  //
  // private function getSudokuImageFile($image)
  // {
  //   $directory = $image->s3_disk . $image->s3_directory;
  //   $directory .= ($image->solutions) ? config('sudokus.solutions_folder') : config('sudokus.puzzles_folder');
  //
  //   $path = $directory . $image->file_name;
  //
  //   return Storage::disk('s3')->response($path);
  // }

}
