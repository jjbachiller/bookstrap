<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
  public function uploadSectionImages(Request $request)
  {
    // FIXME: Validations (exists: session useruid and bookid. Parameters section and image sizes)
    $files = $request->file('files');
    if(!empty($files)) {
      $prepareNames   =   array();
      foreach ($files as $file) {
        if ($file->getError()) continue;

        if($file->getMimeType() == 'image/gif' || $file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/png') {
          // FIXME: Check filesize here.
          $userUid = (Auth::check()) ? Auth::user()->uid : session('user_uid');
          $srcPath    =  config('bookstrap-constants.uploads_path') . $userUid . '/' . getSessionBookUid() . '/' . $request->input('section') . '/';
          if ($request->input('solutions')) {
            $srcPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
          }
          Storage::makeDirectory($srcPath);
          $fileName   =   trim($file->getClientOriginalName());

          if($file->storeAs($srcPath, $fileName))
          {
              // Miniatures generation
              $miniatures = config('bookstrap-constants.miniatures');
              foreach ($miniatures as $miniature) {
                if ($miniature['width'] == 0 || $miniature['height'] == 0) continue;
                makeThumbnails($srcPath, $fileName, $miniature);
              }
              $prepareNames[] .=  $fileName; //need to be fixed.
              $Sflag      =   1; // success
          }else{
              $Sflag  = 2; // file not move to the destination
          }
        }
        else
        {
            $Sflag  = 3; //extension not valid
        }
      }
      if($Sflag==1){
          echo '{Images uploaded successfully!}';
      }else if($Sflag==2){
          echo '{File not move to the destination.}';
      }else if($Sflag==3){
          echo '{File extention not good. Try with .PNG, .JPEG, .GIF, .JPG}';
      }
    }
  }

  public function deleteSectionImage(Request $request) {
    // FIXME: Validate if user exist and if not, if exists any user with this uid ...
      $userUid = (Auth::check()) ? Auth::user()->uid : session('user_uid');
      $srcPath = config('bookstrap-constants.uploads_path') . $userUid . '/' . getSessionBookUid() . '/' . $request->input('section') . '/' . $request->input('image');
      return Storage::delete($srcPath);
  }

}
