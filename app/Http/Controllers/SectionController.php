<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Classes\ImageManager;

class SectionController extends Controller
{

  private function updateOrCreateSection($sectionData)
  {
    $book = \App\Book::findOrFail(session('idBook'));

    $section = empty($sectionData->id) ? new \App\Section : \App\Section::findOrFail($sectionData->id);

    $section->size = 0;
    $section->pages_count = 1; // A section has always a blank pages at the end.

    if ($sectionData->addTitle) {
      $section->title = empty($sectionData->title) ? null : $sectionData->title;
      $section->header = empty($sectionData->titleHeader) ? null : $sectionData->titleHeader;

      if ($sectionData->title) {
        $section->pages_count++;
      }

    } else {
      $section->title = $section->header = null;
    }


    $section->image_name_as_title = $sectionData->imageNameAsTitle;
    $section->images_per_page = $sectionData->imagesPerPage;

    if ($sectionData->addSolutionsTitle) {
      $section->solutions_title = empty($sectionData->solutionsTitle) ? null : $sectionData->solutionsTitle;
      $section->solutions_header = empty($sectionData->solutionsHeader) ? null : $sectionData->solutionsHeader;

      if ($sectionData->solutionsTitle) {
        $section->pages_count++;
      }

    } else {
      $section->solutions_title = $section->solutions_header = null;
    }

    $section->solutions_name_as_title = $sectionData->solutionNameAsTitle;
    $section->solutions_per_page = $sectionData->solutionsPerPage;
    $section->solutions_to_the_end = $sectionData->solutionsToTheEnd;

    // List images in section in order to calculate num pages and total size for the section.
    if (Auth::check()) {
      $section->user_id = Auth::user()->id;
      $userUid = Auth::user()->uid;
    } else {
      $userUid = session('user_uid');
    }

    // $workFolder = config('bookstrap-constants.uploads_path') . $userUid . '/' . $book->uid . '/';
    // $sectionFolder = Storage::path($workFolder) . $sectionData->folder . '/';
    // list($sectionSize, $sectionPages) = getSizeAndPages($sectionFolder);
    // $section->size+= $sectionSize;
    // $section->pages_count+= $sectionPages;
    //
    // $solutionsFolder = $sectionFolder . config('bookstrap-constants.SOLUTIONS_FOLDER');
    // list($solutionsSize, $solutionsPages) = getSizeAndPages($solutionsFolder);
    // $section->size+= $solutionsSize;
    // $section->pages_count+= $solutionsPages;

    $section->order = $sectionData->order ?? null;
    // $section->folder = $sectionData->folder;

    $book->sections()->save($section);

    $section->book->updatedPagesAndSize();

    return $section;
  }

  // FIXME: Clean this method (divide)
  public function uploadSectionImages(Request $request)
  {
    $sectionData = json_decode($request->input('section-data'));
    $section = $this->updateOrCreateSection($sectionData);

    $imgManager = new ImageManager();

    $errorCode = 0;
    $errorMessage = '';

    // FIXME: Validations (exists: session useruid and bookid. Parameters section and image sizes)
    $files = $request->file('files');
    if(!empty($files)) {
      $prepareNames   =   array();
      foreach ($files as $file) {
        if ($file->getError()) continue;

        if($file->getMimeType() == 'image/gif' || $file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/png') {
          // FIXME: Check filesize here.
          $image = $imgManager->saveLocalImage($section, $file, $request->input('solutions'));
          if ($image) {
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
      // if($Sflag==1){
      //     echo '{Images uploaded successfully!}';
      // }else if($Sflag==2){
      if ($Sflag==2) {
          $errorCode = 2;
          $errorMessage = 'File not move to the destination.';
      }else if($Sflag==3){
          $errorCode = 3;
          $errorMessage = 'File extension not good. Try with .PNG, .JPEG, .GIF, .JPG';
      }
    }

    $response = array('sectionId' => $section->id, 'errorCode' => $errorCode, 'errorMessage' => $errorMessage);

    return response()->json($response);
  }

  public function loadSudokuImages(Request $request) {
    $sudokusData = json_decode($request->getContent(), true);
    // $sectionData = (object) $sudokusData['section-data'];
    // $section = $this->updateSection($sectionData);

    $section = \App\Section::findOrFail($sudokusData['section-id']);

    $imgManager = new ImageManager();

    $difficulty = $sudokusData['difficulty'];
    $sudokusNumber = $sudokusData['number'];

    $counter = $section->images->where('s3_disk', config('sudokus.sudokus_folder'))->count() + 1;
    $sudokusList = randomGen(0, config('sudokus.max_number'), $sudokusNumber);
    $images = $solutions = [];
    foreach ($sudokusList as $sudoku) {
      $fileName = $sudoku  . config('sudokus.ext');
      $showName = 'Sudoku ' . $counter;
      $image = $imgManager->saveSudokuImage($section, $difficulty, $fileName, $showName);

      $images[] = $image;

      $showName = 'Solution ' . $counter;
      $solution = $imgManager->saveSudokuImage($section, $difficulty, $fileName, $showName, true);

      $solutions[] = $solution;

      $counter++;
    }

    $response = array('images' => $images, 'solutions' => $solutions);

    // echo json_encode($response);
    return response()->json($response);
  }

  public function updateSection(Request $request)
  {
    $requestData = json_decode($request->getContent(), true);
    $sectionData = (object) $requestData['section-data'];

    $section = $this->updateOrCreateSection($sectionData);

    return $section;
  }

  public function  updateSections(Request $request) {
    $updatedData = json_decode($request->getContent(), true);
    $sections = $updatedData['sections'];
    foreach ($sections as $sectionArray) {
      $sectionObject = (object) $sectionArray;
      $this->updateOrCreateSection($sectionObject);
    }

    $response = array('result' => 'ok');
    echo json_encode($response);
  }

  public function deleteSectionImage(Request $request) {
      // FIXME: Validate if user exist and if not, if exists any user with this uid ...
      $userUid = (Auth::check()) ? Auth::user()->uid : session('user_uid');
      $srcPath = config('bookstrap-constants.uploads_path') . $userUid . '/' . getSessionBookUid() . '/' . $request->input('section') . '/';
      if ($request->input('solutions')) {
        $srcPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
      }
      $srcPath.= $request->input('image');
      return Storage::delete($srcPath);
  }

}
