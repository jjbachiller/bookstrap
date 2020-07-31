<?php
  use Illuminate\Support\Facades\Storage;

  function pixelsToMM($val)
  {
    return round($val * config('bookstrap-constants.INCH_IN_MM') / config('bookstrap-constants.DPI'), 2);
  }

  function mmToPixels($val)
  {
    return round($val * config('bookstrap-constants.DPI') / config('bookstrap-constants.INCH_IN_MM'), 2);
  }

/*
  function pointsToPixels($val)
  {
    return $val * config('constants.POINT_IN_PIXELS');
  }

  function pointsToMM($val)
  {
    return $val * config('constants.POINT_IN_MM');
  }
*/

  function preprocessText($text)
  {
    $text = trim($text);
    ////////////////// To print special chars correctly????
    $text = stripslashes($text);
    $text = iconv('UTF-8', 'windows-1252', $text);
    ///////////////////////
    return $text;
  }

  function getSessionBookUid($idBook = null)
  {
    $id = $idBook ?? session('idBook');
    $book = \App\Book::findOrFail($id);
    return $book->uid;
  }

  function formatBytes($bytes, $precision = 2) {
    $units = array('Bytes', 'KBytes', 'MBytes', 'GBytes', 'TBytes');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
  }

  function moveStorageBookContent($from, $to)
  {
    $subfolders = Storage::directories($from);
    foreach ($subfolders as $subfolder) {
      try {
        $pathElements = explode("/", $subfolder);
        $directoryToMove = array_pop($pathElements);
        // Added the subfolder name to the destination
        $newDirectoryPath= $to . '/' . $directoryToMove;
        Storage::move($subfolder, $newDirectoryPath);
      } catch (Throwable $e) {}
    }
  }

  function moveUserContent($tmpUserUid, $realUserUid)
  {
    $from = config('bookstrap-constants.uploads_path') . $tmpUserUid;
    $to = config('bookstrap-constants.uploads_path') . $realUserUid;
    moveStorageBookContent($from, $to);
    Storage::deleteDirectory($from);
    $from = config('bookstrap-constants.downloads_path') . $tmpUserUid;
    $to = config('bookstrap-constants.downloads_path') . $realUserUid;
    moveStorageBookContent($from, $to);
    Storage::deleteDirectory($from);
  }

  function makeThumbnails($basedir, $img, $miniature)
  {
    $imgPath = Storage::path($basedir) . $img;

    $size = getimagesize($imgPath);
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
      $new_width = $miniature['width'];
      $new_height = $miniature['width']/$ratio;
    }
    else {
      $new_width = $miniature['width']*$ratio;
      $new_height = $miniature['width'];
    }
    /*
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($original_width > $original_height) {
        $new_width = $miniature['width'];
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $miniature['height'];
        $new_width = intval($original_width * $new_height / $original_height);
    }

    $dest_x = intval(($miniature['width'] - $new_width) / 2);
    $dest_y = intval(($miniature['height'] - $new_height) / 2);
    */
    if ($size[2] == IMAGETYPE_GIF) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($size[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($size[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }

    if ($imgt) {
      $old_image = $imgcreatefrom($imgPath);
      // $new_image = imagecreatetruecolor($miniature['width'], $miniature['height']);
      $new_image = imagecreatetruecolor($new_width, $new_height);
      imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
      $miniatureFolder = $basedir . '/' . $miniature['folder'];
      Storage::makeDirectory($miniatureFolder);
      $miniaturePath = Storage::path($miniatureFolder) . $img;
      $imgt($new_image, $miniaturePath);
    }
  }
