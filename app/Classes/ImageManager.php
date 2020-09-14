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

  public static function saveSudokuImage($section, $difficulty, $file_name, $show_name, $solution = false)
  {
    $image = new \App\Image;
    $image->s3_disk = config('sudokus.sudokus_folder');
    $image->s3_directory = $difficulty;
    $image->file_name = $file_name;
    $image->show_name = $show_name;
    $image->size = config('sudokus.size');;
    $image->width = config('sudokus.width');
    $image->height = config('sudokus.height');
    $image->type = config('sudokus.type');
    $image->solution = $solution;
    $section->content()->save($image);

    self::saveS3ImageLocally($image);

    return $image;
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
}
