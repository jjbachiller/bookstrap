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
    if (Auth::check()) {
      $section->user_id = Auth::user()->id;
      $userUid = Auth::user()->uid;
    } else {
      $userUid = session('user_uid');
    }

    $section->order = $sectionData->order ?? null;

    $book->sections()->save($section);

    $section->book->updatedPagesAndSize();

    return $section;
  }

  // FIXME: Clean this method (divide)
  public function uploadSectionImages(Request $request)
  {
    $sectionData = json_decode($request->input('section-data'));
    $section = $this->updateOrCreateSection($sectionData);

    $errorCode = 0;
    $errorMessage = '';

    // FIXME: Validations (exists: session useruid and bookid. Parameters section and image sizes)
    $files = $request->file('files');
    $images = [];
    if(!empty($files)) {
      $prepareNames   =   array();
      foreach ($files as $file) {
        if ($file->getError()) continue;

        if($file->getMimeType() == 'image/gif' || $file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/png') {
          // FIXME: Check filesize here.
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

  public function loadSudokuImages(Request $request) {
    $sudokusData = json_decode($request->getContent(), true);

    $section = \App\Section::findOrFail($sudokusData['section-id']);

    $difficulty = $sudokusData['difficulty'];
    $sudokusNumber = $sudokusData['number'];

    $counter = $section->images->where('s3_disk', config('sudokus.sudokus_folder'))->count() + 1;
    $sudokusList = randomGen(0, config('sudokus.max_number'), $sudokusNumber);
    $images = $solutions = [];
    foreach ($sudokusList as $sudoku) {
      $fileName = $sudoku  . config('sudokus.ext');
      $showName = 'Sudoku ' . $counter;
      $image = ImageManager::saveSudokuImage($section, $difficulty, $fileName, $showName);

      $images[] = $image;

      $showName = 'Solution ' . $counter;
      $solution = ImageManager::saveSudokuImage($section, $difficulty, $fileName, $showName, true);

      $solutions[] = $solution;

      $counter++;
    }

    $response = array('images' => $images, 'solutions' => $solutions);

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

  public function deleteSection(Request $request) {
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

  public function deleteSectionImage(Request $request) {

      $image = \App\Image::findOrFail($request->input('imageId'));

      // Verify image is from the user.
      if ($image->section->user_id != Auth::user()->id) {
        abort(404);
      }

      return ImageManager::deleteImage($image);

  }

}
