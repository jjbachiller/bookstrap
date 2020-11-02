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

  function getSizeAndPages($folder) {
    $size = $pages = 0;
    $filenames = glob($folder.'*');
    foreach ($filenames as $imgFile) {
      $fileinfo = new \SplFileInfo($imgFile);
      if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
      $size += $fileinfo->getSize();
      $pages++;
    }
    return array($size, $pages);
  }

  function getImageLinksFromFolder($realFolder, $virtualFolder, $size = 'preview') {
    $images = [];
    $filenames = glob($realFolder.'*');
    natsort($filenames);
    foreach ($filenames as $filename) {
      $fileinfo = new \SplFileInfo($filename);
      if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
      // Show miniatures in order to save bandwith
      $miniatures = config('bookstrap-constants.miniatures');
      $images[] = url($virtualFolder  . $miniatures[$size]['folder'] . basename($filename));
    }
    return $images;
  }

  function getImageExtendedDataFromFolder($folder, $virtualFolder)
  {
    $images = [];
    $filenames = glob($folder.'*');
    natsort($filenames);
    foreach ($filenames as $imgFile) {
      // $data = ['procesing' => true, 'accepted' => true, 'status' => 'success'];
      $data = [];
      $fileinfo = new \SplFileInfo($imgFile);
      if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
      $data['name'] = $fileinfo->getFilename();
      $data['size'] = $fileinfo->getSize();
      $data['type'] = $fileinfo->getType();
      // Virtual url to the resource
      $fileVirtualPath = $virtualFolder . 'preview/' . $fileinfo->getFilename();
      $images[] = ['data' => $data, 'url' => url($fileVirtualPath)];
    }
    return $images;
  }

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
      // For png transparency
      if ($size[2] == IMAGETYPE_PNG) {
        $white = imagecolorallocate($new_image, 255, 255, 255);
        imagefill($new_image,0,0,$white);
      }
      imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
      $miniatureFolder = $basedir . '/' . $miniature['folder'];
      Storage::makeDirectory($miniatureFolder);
      $miniaturePath = Storage::path($miniatureFolder) . $img;
      $imgt($new_image, $miniaturePath);
    }
  }

  function calculateImageMaxDimensions($bookMaxWidth, $bookMaxHeight, $totalImages)
  {
    switch ($totalImages) {
      case 1:
        $imageMaxWidth = $bookMaxWidth;
        $imageMaxHeight = $bookMaxHeight;
        break;
      case 2:
        $imageMaxWidth = $bookMaxWidth;
        $imageMaxHeight = $bookMaxHeight / 2;
        break;
      case 3:
      case 6:
        $imageMaxWidth = $bookMaxWidth / 2;
        $imageMaxHeight = $bookMaxHeight / 3;
        break;
      case 4:
        $imageMaxWidth = $bookMaxWidth / 2;
        $imageMaxHeight = $bookMaxHeight / 2;
        break;
      case 5:
      case 9:
        $imageMaxWidth = $bookMaxWidth / 3;
        $imageMaxHeight = $bookMaxHeight / 3;
        break;
      case 7:
      case 8:
        $imageMaxWidth = $bookMaxWidth / 2;
        $imageMaxHeight = $bookMaxHeight / 4;
        break;
      case 10:
      case 11:
      case 12:
        $imageMaxWidth = $bookMaxWidth / 3;
        $imageMaxHeight = $bookMaxHeight / 4;
        break;
      case 13:
      case 14:
      case 15:
      case 16:
      case 17:
      case 18:
        $imageMaxWidth = $bookMaxWidth / 3;
        $imageMaxHeight = $bookMaxHeight / 6;
        break;
      default: // From 19 to 24
        $imageMaxWidth = $bookMaxWidth / 4;
        $imageMaxHeight = $bookMaxHeight / 6;
    }

    return [$imageMaxWidth, $imageMaxHeight];
  }

  function calculateImageOffset($totalImages, $currentImage, $imageMaxWidth, $imageMaxHeight)
  {
    switch ($currentImage) {
      case 2:

        if ($totalImages == 2) {
          $offsetX = 0;
          $offsetY = $imageMaxHeight;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = 0;
        }

        break;
      case 3:

        if ($totalImages < 9) {
          $offsetX = 0;
          $offsetY = $imageMaxHeight;
        } else {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = 0;
        }

        break;
      case 4:

        if ($totalImages < 9) {

          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;

        } elseif ($totalImages < 24) {

          $offsetX = 0;
          $offsetY = $imageMaxHeight;

        } else {

          $offsetX = $imageMaxWidth * 3;
          $offsetY = 0;

        }

        break;
      case 5:
        // Same offset for 5 or 6 images
        if ($totalImages < 9) {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 2;
        } elseif ($totalImages < 24) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;
        } else {
          $offsetX = 0;
          $offsetY = $imageMaxHeight;
        }

        break;
      case 6:
        if ($totalImages < 9) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 2;
        } elseif ($totalImages < 24) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;
        }

        break;
      case 7:
        if ($totalImages < 9) {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 3;
        } elseif ($totalImages < 24) {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 2;
        } else {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight;
        }

        break;
      case 8:
        if ($totalImages < 9) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 3;
        } elseif ($totalImages < 19) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 2;
        } else {
          $offsetX = $imageMaxWidth * 3;
          $offsetY = $imageMaxHeight;
        }
        break;
      case 9:
        if ($totalImages < 24) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 2;
        } else {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 2;
        }

        break;
      case 10:
        if ($totalImages < 24) {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 3;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 2;
        }

        break;
      case 11:
        if ($totalImages < 24) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 3;
        } else {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 2;
        }

        break;
      case 12:
        if ($totalImages < 24) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 3;
        } else {
          $offsetX = $imageMaxWidth * 3;
          $offsetY = $imageMaxHeight * 2;
        }

        break;
      case 13:
        $offsetX = 0;
        $offsetY = $imageMaxHeight * 3;

        break;
      case 14:
        $offsetX = $imageMaxWidth;
        $offsetY = $imageMaxHeight * 3;

        break;
      case 15:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 3;

        break;
      case 16:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 3;

        break;
      case 17:
        $offsetX = 0;
        $offsetY = $imageMaxHeight * 4;

        break;
      case 18:
        $offsetX = $imageMaxWidth;
        $offsetY = $imageMaxHeight * 4;

        break;
      case 19:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 4;

        break;
      case 20:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 4;

        break;
      case 21:
        $offsetX = 0;
        $offsetY = $imageMaxHeight * 5;

        break;
      case 22:
        $offsetX = $imageMaxWidth;
        $offsetY = $imageMaxHeight * 5;

        break;
      case 23:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 5;

        break;
      case 24:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 5;

        break;
      default:
        $offsetX = $offsetY = 0;
    }

    return [$offsetX, $offsetY];
  }

  function calculateImageOffsetOld($totalImages, $currentImage, $imageMaxWidth, $imageMaxHeight)
  {
    switch ($currentImage) {
      case 2:
        $offsetX = 0;

        if ($totalImages == 2 || $totalImages == 4 || $totalImages >= 6) {
          $offsetY = $imageMaxHeight;
        } else {
          $offsetY = $imageMaxHeight * 2;
        }

        break;
      case 3:

        if ($totalImages == 3) {
          // Centered on the right side of the page
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;

        } elseif ($totalImages == 4) {

          $offsetX = $imageMaxWidth;
          $offsetY = 0;

        } elseif ($totalImages == 5) {

          $offsetX = $imageMaxWidth * 2;
          $offsetY = 0;

        } else {

          $offsetX = 0;
          $offsetY = $imageMaxHeight * 2;

        }

        break;
      case 4:

        if ($totalImages == 4) {

          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;

        } elseif ($totalImages == 5) {

          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 2;

        } elseif ($totalImages == 6 || $totalImages == 9) {

          $offsetX = $imageMaxWidth;
          $offsetY = 0;

        } else {

          $offsetX = 0;
          $offsetY = $imageMaxHeight * 3;

        }

        break;
      case 5:
        // Same offset for 5 or 6 images
        if ($totalImages <= 6 || $totalImages == 9) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;
        } elseif ($totalImages < 13) {
          $offsetX = $imageMaxWidth;
          $offsetY = 0;
        } else {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 4;
        }

        break;
      case 6:
        if ($totalImages == 6 || $totalImages == 9) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 2;
        } elseif ($totalImages < 13) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;
        } else {
          $offsetX = 0;
          $offsetY = $imageMaxHeight * 5;
        }

        break;
      case 7:
        if ($totalImages == 9) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = 0;
        } elseif ($totalImages < 13) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 2;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = 0;
        }

        break;
      case 8:
        if ($totalImages == 9) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight;
        } elseif ($totalImages < 13) {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 3;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight;
        }
        break;
      case 9:
        if ($totalImages == 9) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 2;
        } elseif ($totalImages < 13) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = 0;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 2;
        }

        break;
      case 10:
        if ($totalImages < 13) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 3;
        }

        break;
      case 11:
        if ($totalImages < 13) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 2;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 4;
        }

        break;
      case 12:
        if ($totalImages < 13) {
          $offsetX = $imageMaxWidth * 2;
          $offsetY = $imageMaxHeight * 3;
        } else {
          $offsetX = $imageMaxWidth;
          $offsetY = $imageMaxHeight * 5;
        }

        break;
      case 13:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = 0;

        break;
      case 14:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight;

        break;
      case 15:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 2;

        break;
      case 16:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 3;

        break;
      case 17:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 4;

        break;
      case 18:
        $offsetX = $imageMaxWidth * 2;
        $offsetY = $imageMaxHeight * 5;

        break;
      case 19:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = 0;

        break;
      case 20:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight;

        break;
      case 21:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 2;

        break;
      case 22:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 3;

        break;
      case 23:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 4;

        break;
      case 24:
        $offsetX = $imageMaxWidth * 3;
        $offsetY = $imageMaxHeight * 5;

        break;
      default:
        $offsetX = $offsetY = 0;
    }

    return [$offsetX, $offsetY];
  }

  // Scale the original image to fit the document size
  function scaleToFit($image, $maxWidth, $maxHeight)
  {
      // list($width, $height) = getimagesize($image);

      $width = pixelsToMM($image->width);
      $height = pixelsToMM($image->height);

      $widthScale = $maxWidth / $width;
      $heightScale = $maxHeight / $height;

      $scale = min($widthScale, $heightScale);

      $inDocumentWidth = $scale * $width;
      $inDocumentHeight = $scale * $height;

      return array($inDocumentWidth, $inDocumentHeight);
  }

  function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
  }

  function getBookFileSizeFromUrl($bookFileUrl) {
    $urlData = parse_url($bookFileUrl);
    $urlSegments = explode('/', $urlData['path']);
    if (count($urlSegments) != 5) {
      return 0;
    }

    $bookUid = $urlSegments[2];
    $date = $urlSegments[3];
    $book = $urlSegments[4];

    $userUid =  Auth::user()->uid;

    $bookPath = config('bookstrap-constants.downloads_path') . $userUid . '/' . $bookUid . '/' . $date  . '/' . $book;
    $file = Storage::path($bookPath);
    if (!is_file($file)) {
      return 0;
    }
    return filesize($file);
  }
