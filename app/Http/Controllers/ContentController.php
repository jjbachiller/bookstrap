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
        // Images
        $sectionPath = $srcPath . $folder . '/';
        $sectionVirtualPath = $virtualPath . $folder . '/';
        $images = getImageLinksFromFolder($sectionPath, $sectionVirtualPath);
        // Solutions
        $sectionPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
        $sectionVirtualPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
        $solutions = getImageLinksFromFolder($sectionPath, $sectionVirtualPath);

        $sectionsContent[$folder] = ['images' => $images, 'solutions' => $solutions];
      }
      echo json_encode(['order' => $sectionFolders, 'sections' => $sectionsContent]);
    }

    public function getContent($bookUid, $section, $size, $image, $solutions = false)
    {
      $userUid =  Auth::check() ? Auth::user()->uid : session('user_uid');
      // Validate image is from the user else --> 404
      $contentPath = config('bookstrap-constants.uploads_path') . $userUid . '/' . $bookUid . '/' . $section . '/';
      if ($solutions) {
        $contentPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
      }
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

    public function getSolutionsContent($bookUid, $section, $size, $image)
    {
      return $this->getContent($bookUid, $section, $size, $image, true);
    }

}
