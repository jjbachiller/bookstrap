<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Classes\ImageManager;
use App\Jobs\LoadS3ContentJob;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{

  private function updateSectionData($sectionData)
  {
    $section = \App\Section::findOrFail($sectionData->id);

    if ($sectionData->addTitle) {
      $section->title = empty($sectionData->title) ? null : $sectionData->title;
      $section->header = empty($sectionData->titleHeader) ? null : $sectionData->titleHeader;
    } else {
      $section->title = $section->header = null;
    }

    if ($sectionData->addSolutionsTitle) {
      $section->solutions_title = empty($sectionData->solutionsTitle) ? null : $sectionData->solutionsTitle;
      $section->solutions_header = empty($sectionData->solutionsHeader) ? null : $sectionData->solutionsHeader;
    } else {
      $section->solutions_title = $section->solutions_header = null;
    }


    $section->image_name_as_title = $sectionData->imageNameAsTitle;
    $section->images_per_page = $sectionData->imagesPerPage;

    $section->solutions_name_as_title = $sectionData->solutionNameAsTitle;
    $section->solutions_per_page = $sectionData->solutionsPerPage;
    $section->solutions_to_the_end = $sectionData->solutionsToTheEnd;

    // List images in section in order to calculate num pages and total size for the section.
    // if (Auth::check()) {
    //   $section->user_id = Auth::user()->id;
    //   $userUid = Auth::user()->uid;
    // } else {
    //   $userUid = session('user_uid');
    // }

    $section->order = $sectionData->order ?? null;

    $section->save();

    $section->book->updatedPagesAndSize();

    return $section;
  }

  // FIXME: Clean this method (divide)
  public function uploadSectionImages(Request $request)
  {
    if (Gate::allows('active-subscription')) {
      $sectionData = json_decode($request->input('section-data'));
      $section = $this->updateSectionData($sectionData);

      $errorCode = 0;
      $errorMessage = '';

      // FIXME: Validations (exists: session useruid and bookid. Parameters section and image sizes)
      $files = $request->file('files');
      $images = [];
      $batchSize = 0;
      if(!empty($files)) {
        $prepareNames   =   array();
        foreach ($files as $file) {
          if ($file->getError()) continue;

          if($file->getMimeType() == 'image/gif' || $file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/png') {
            $batchSize+= $file->getSize();
            if (Gate::denies('space-available', $batchSize)) {
              $error = [
                'deny' => config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.code'),
                'message' => config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.message'),
                'sectionId' => $section->id,
                'images' => $images,
              ];

              return response()->json($error);
            }

            $image = ImageManager::saveLocalImage($section, $file, $request->input('solutions'));
            if ($image) {
              $images[] = $image;
              $Sflag = 1;
            }else{
              $Sflag = 2; // file not move to the destination
            }
          }
          else
          {
              $Sflag  = 3; //extension not valid
            }
          }

          if ($Sflag==2) {
            $errorCode = 2;
            $errorMessage = 'File not move to the destination.';
          }else if($Sflag==3){
            $errorCode = 3;
            $errorMessage = 'File extension not good. Try with .PNG, .JPEG, .GIF, .JPG';
          }
        }

        $response = array('sectionId' => $section->id, 'images' => $images, 'errorCode' => $errorCode, 'errorMessage' => $errorMessage);

        return response()->json($response);
      }
  }

  public function loadLibraryContent(Request $request) {
    if (Gate::allows('active-subscription')) {
      $contentData = json_decode($request->getContent(), true); 
      $section = \App\Section::findOrFail($contentData['section_id']); 
      if (!config('categories.list.' . $contentData['content_type'])) {
        abort(404);
      }

      LoadS3ContentJob::dispatch(Auth::user(), $section, $contentData);
      // $response = ImageManager::saveLibraryImages($contentData, $section, $config);
      $response = ['ok' => true];
      return response()->json($response);
    }
  }

  public function createSection(Request $request)
  {
    $book = \App\Book::findOrFail(session('idBook'));
    $section = new \App\Section;
    $section->user_id = Auth::user()->id;
    $book->sections()->save($section);
    return $section;
  }

  public function updateSection(Request $request)
  {
    if (Gate::denies('active-subscription')) {
      request()->session()->flash('deny', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.code'));
      request()->session()->flash('message', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message'));
      return redirect()->route('books.index');
    }

    $requestData = json_decode($request->getContent(), true);
    $sectionData = (object) $requestData['section-data'];

    $section = $this->updateSectionData($sectionData);

    return $section;
  }

  public function  updateSections(Request $request) {
    if (Gate::denies('active-subscription')) {
      request()->session()->flash('deny', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.code'));
      request()->session()->flash('message', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message'));
      return redirect()->route('books.index');
    }

    $updatedData = json_decode($request->getContent(), true);
    $sections = $updatedData['sections'];
    foreach ($sections as $sectionArray) {
      $sectionObject = (object) $sectionArray;
      $this->updateSectionData($sectionObject);
    }

    $response = array('result' => 'ok');
    echo json_encode($response);
  }

  public function deleteSection(Request $request) {
    if (Gate::allows('active-subscription')) {
      $section = \App\Section::findOrFail($request->input('sectionId'));

      // Verify section is from the user.
      if ($section->user_id != Auth::user()->id) {
        abort(404);
      }

      // Delete the section folder
      Storage::deleteDirectory($section->getContentFolder());

      // Delete the section from the database.
      $section->deleteWithImages();
    }
  }

  public function deleteSectionImage(Request $request) {
    if (Gate::allows('active-subscription')) {
      $image = \App\Image::findOrFail($request->input('imageId'));

      // Verify image is from the user.
      if ($image->section->user_id != Auth::user()->id) {
        abort(404);
      }

      return ImageManager::deleteImage($image);
    }
  }

}
