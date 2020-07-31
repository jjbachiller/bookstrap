<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{

    public function getPreviewContent(Request $request)
    {
      $userUid = (Auth::check()) ? Auth::user()->uid : session('user_uid');
      $srcPath = config('bookstrap-constants.uploads_path') . $userUid . '/' . getSessionBookUid() . '/';
      $srcPath = Storage::path($srcPath);
      $virtualPath = config('bookstrap-constants.uploads_virtual_path') . getSessionBookUid() . '/';
      $sectionFolders = $request->input('sections');
      $sectionsContent = [];
      foreach($sectionFolders as $folder) {
        $images = Array();
        $sectionPath = $srcPath . $folder . '/';
        $sectionVirtualPath = $virtualPath . $folder . '/';
        $filenames = glob($sectionPath.'*');
        natsort($filenames);
        foreach ($filenames as $filename) {
          $fileinfo = new \SplFileInfo($filename);
          if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
          // Show miniatures in order to save bandwith
          $miniatures = config('bookstrap-constants.miniatures');
          $images[] = url($sectionVirtualPath  . $miniatures['preview']['folder'] . basename($filename));
        }
        $sectionsContent[$folder] = $images;
      }
      echo json_encode(['order' => $sectionFolders, 'sections' => $sectionsContent]);
    }

    public function getContent($bookUid, $section, $size, $image)
    {
      $userUid =  Auth::check() ? Auth::user()->uid : session('user_uid');
      // Validate image is from the user else --> 404
      $contentPath = config('bookstrap-constants.uploads_path') . $userUid . '/' . $bookUid . '/' . $section . '/';
      $miniatures = config('bookstrap-constants.miniatures');
      if (!array_key_exists($size, $miniatures)) {
        abort(404);
      }
      $contentPath.= $miniatures[$size]['folder'];

      $contentPath.= $image;
      $file = Storage::path($contentPath);
      if (!is_file($file)) {
        abort(404);
      }
      return response()->file($file);
    }

}
