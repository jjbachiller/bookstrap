<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Bookstrap\MetaBook;
use App\Bookstrap\PDF;
use App\Bookstrap\PPT;

use Carbon\Carbon;

class WizardController extends Controller
{
  // Start the step by step wizard
  public function start(Request $request)
  {
    if (Gate::denies('active-subscription')) {
      $request->session()->flash('deny', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.code'));
      $request->session()->flash('message', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message'));
      return redirect()->route('books.index');
    }

    if (Gate::denies('total-pages-available')) {
      $request->session()->flash('deny', config('bookstrap-constants.DENIES.TOTAL_PAGES.code'));
      $request->session()->flash('message', config('bookstrap-constants.DENIES.TOTAL_PAGES.message'));
      return redirect()->route('books.index');
    }

    $bookUid = uniqid();
    $book = new \App\Book;
    $book->uid = $bookUid;
    if (Auth::check()) {
      $userUid = Auth::user()->uid;
      $book->user_id = Auth::user()->id;
    } else {
      // if is a guess: generate a new user uniqid
      $userUid = uniqid();
    }
    $book->save();
    session(['user_uid' => $userUid]);
    session(['idBook' => $book->id]);
    return view('wizard.content', compact($book));
  }

  // XHR call to generate a file with all the configuration/data selected.
  public function generateBookFile(Request $request)
  {
    if (Gate::allows('active-subscription')) {

      $configuration = json_decode($request->getContent(), true);

      // $book = $this->updateSessionBook($configuration);

      $book = \App\Book::findOrFail(session('idBook'));

      $metaBook = new MetaBook($book);

      if (Gate::denies('total-pages-available')) {
        $response = array('file_url' => '', 'error' => config('bookstrap-constants.DENIES.TOTAL_PAGES.code'));
        echo json_encode($response);
        return;
      }

      if (Gate::denies('book-pages-in-limit', $book->total_pages)) {
        $response = array('file_url' => '', 'error' => config('bookstrap-constants.DENIES.BOOK_PAGES.code'));
        echo json_encode($response);
        return;
      }

      if ($configuration['filetype'] == config('bookstrap-constants.PDF'))
      {
        $pdf = new PDF($metaBook);
        $ext = config('bookstrap-constants.PDF_EXTENSION');
        $file = $pdf->generatePDF();
        $book->pdf = $metaBook->getBookDownloadUrl() . $ext;
      } else {
        $ppt = new PPT($metaBook);
        $ext = config('bookstrap-constants.PPT_EXTENSION');
        $file = $ppt->generatePPT();
        $book->ppt = $metaBook->getBookDownloadUrl() . $ext;
      }

      $response = array('file_url' => '', 'error' => 0);
      if (is_file($file)) {
        $response['file_url'] = $metaBook->getBookDownloadUrl() . $ext;

        $book->save();

        $book->updatedPagesAndSize();
      } else {
        $response['error'] = 1;
      }
      echo json_encode($response);

    }
  }

  // private function updateSessionBook($configuration)
  // {
  //   $book = \App\Book::findOrFail(session('idBook'));
  //   $book->name = $configuration['filename'];
  //   $bookTypes = config('book-types');
  //   $book->book_type = array_key_exists($configuration['type'], $bookTypes) ? $configuration['type'] : array_shift($bookTypes);
  //   $bookSizes = config('book-sizes');
  //   $book->dimensions = array_key_exists($configuration['size'], $bookSizes) ? $configuration['size'] : reset($bookSizes);
  //   $book->img_position = $configuration['imagePosition'];
  //   $book->img_scale = $configuration['imageSize'];
  //   $book->footer_details = $configuration['footer']['addFooter'] ? $configuration['footer']['text'] : '';
  //   $book->page_number_position = $configuration['pageNumber']['addPageNumber'] ? $configuration['pageNumber']['position'] : 0;
  //   $book->add_blank_pages = $configuration['addBlankPages'];
  //   $book->full_bleed = $configuration['fullBleed'];
  //   $book->total_pages = $configuration['totalPages'];
  //   if (!Auth::check()) {
  //     $book->created_as_guess = true;
  //   }
  //   $book->save();
  //
  //   // $this->updateBookSections($book, $configuration['sections']);
  //
  //   return $book;
  // }

  // private function updateBookSections($book, $sections)
  // {
  //   // Delete book old sections
  //   $book->resetContent();
  //   $sectionOrder = 1;
  //   // Create and add the new sections.
  //   $total_size = 0;
  //   foreach ($sections as $sec)
  //   {
  //     $section = new \App\Section;
  //
  //     $section->size = 0;
  //     $section->pages_count = 1; // A section has always a blank pages at the end.
  //
  //     if ($sec['title']) {
  //       $section->pages_count++;
  //     }
  //
  //     if ($sec['addTitle']) {
  //       $section->title = empty($sec['title']) ? null : $sec['title'];
  //       $section->header = empty($sec['titleHeader']) ? null : $sec['titleHeader'];
  //     } else {
  //       $section->title = $section->header = null;
  //     }
  //
  //
  //     $section->image_name_as_title = $sec['imageNameAsTitle'];
  //     $section->images_per_page = $sec['imagesPerPage'];
  //
  //     if ($sec['solutionsTitle']) {
  //       $section->pages_count++;
  //     }
  //
  //     if ($sec['addSolutionsTitle']) {
  //       $section->solutions_title = empty($sec['solutionsTitle']) ? null : $sec['solutionsTitle'];
  //       $section->solutions_header = empty($sec['solutionsHeader']) ? null : $sec['solutionsHeader'];
  //     } else {
  //       $section->solutions_title = $section->solutions_header = null;
  //     }
  //
  //     $section->solutions_name_as_title = $sec['solutionNameAsTitle'];
  //     $section->solutions_per_page = $sec['solutionsPerPage'];
  //     $section->solutions_to_the_end = $sec['solutionsToTheEnd'];
  //
  //     // List images in section in order to calculate num pages and total size for the section.
  //     if (Auth::check()) {
  //       $section->user_id = Auth::user()->id;
  //       $userUid = Auth::user()->uid;
  //     } else {
  //       $userUid = session('user_uid');
  //     }
  //
  //     $workFolder = config('bookstrap-constants.uploads_path') . $userUid . '/' . $book->uid . '/';
  //     $sectionFolder = Storage::path($workFolder) . $sec['folder'] . '/';
  //     list($sectionSize, $sectionPages) = getSizeAndPages($sectionFolder);
  //     $section->size+= $sectionSize;
  //     $section->pages_count+= $sectionPages;
  //
  //     $solutionsFolder = $sectionFolder . config('bookstrap-constants.SOLUTIONS_FOLDER');
  //     list($solutionsSize, $solutionsPages) = getSizeAndPages($solutionsFolder);
  //     $section->size+= $solutionsSize;
  //     $section->pages_count+= $solutionsPages;
  //
  //     $total_size+= $section->size;
  //
  //     $section->order = $sectionOrder;
  //     $section->folder = $sec['folder'];
  //
  //     $book->sections()->save($section);
  //
  //     $sectionOrder++;
  //   }
  //   $book->total_size = $total_size;
  //   $book->save();
  // }


}
