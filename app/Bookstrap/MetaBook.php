<?php

namespace App\Bookstrap;

use App\Book;
use App\Bookstrap\BookSettings;
use App\Bookstrap\Page;
use App\Classes\ImageManager;
use Illuminate\Support\Facades\Storage;

class MetaBook {

  private $bookSettings;
  private $currentSection;
  private $pages;

  public function __construct (Book $book)
  {
    $this->bookSettings = new BookSettings($book);
    $this->pages = [];
    $this->fillBookPages();
  }

  private function fillBookPages()
  {
    $pageNumber = 1;
    $book = $this->bookSettings->getBook();
    $sections = $book->sections;

    $solutionsToTheEnd = [];
    foreach ($sections as $section)
    {
      $this->currentSection = $section;
      if (!empty($section->title)) {
        $this->addTitlePage($pageNumber);
        $pageNumber++;

        if ($book->add_blank_pages) {
          $this->addBlankPage($pageNumber);
          $pageNumber++;
        }
      }
      //Get section folder and get sorten images
      // foreach image add a image page and a blank page if this options is selected.
      // $sectionFolder = Storage::path($section->getContentFolder());
      $pageNumber = $this->fillSectionPages($section->images, $pageNumber, false);

      if ($section->solutions_to_the_end) {
          // postponed solution
          $solutionsToTheEnd[] = $section;
      } else {

        if (!is_null($section->solutions_title)) {
          $this->addTitlePage($pageNumber, true);
          $pageNumber++;

          if ($book->add_blank_pages) {
            $this->addBlankPage($pageNumber);
            $pageNumber++;
          }
        }

        // $solutionsFolder = Storage::path($section->getSolutionsFolder());

        // $pageNumber = $this->fillSectionPages($solutionsFolder, $pageNumber, $section->solutions_per_page, $book->add_blank_pages, true);
        $pageNumber = $this->fillSectionPages($section->solutions, $pageNumber, true);
      }

    }

    // Load the postoponed solutions to the end.
    foreach($solutionsToTheEnd as $section) {
      $this->currentSection = $section;
      if (!is_null($section->solutions_title)) {
        $this->addTitlePage($pageNumber, true);
        $pageNumber++;

        if ($book->add_blank_pages) {
          $this->addBlankPage($pageNumber);
          $pageNumber++;
        }
      }

      // $solutionsFolder = Storage::path($section->getSolutionsFolder());

      // $pageNumber = $this->fillSectionPages($solutionsFolder, $pageNumber, $section->solutions_per_page, $book->add_blank_pages, true);
      $pageNumber = $this->fillSectionPages($section->solutions, $pageNumber, true);
    }

  }

  // private function fillSectionPages($section, $pageNumber, $solutions = false)
  private function fillSectionPages($images, $pageNumber, $solutions = false)
  {
    $imagesCurrentPage = [];
    // $filenames = glob($folder.'*');
    // natsort($filenames);
    // foreach ($filenames as $imgFile) {
    $imagesPerPage = false;
    foreach ($images as $image) {
      // $fileinfo = new \SplFileInfo($imgFile);
      // if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
      $imagesCurrentPage[] = $image;

      if (!$imagesPerPage) {
        $imagesPerPage = ($solutions) ? $image->section->solutions_per_page : $image->section->images_per_page;
      }

      if (count($imagesCurrentPage) == $imagesPerPage) {
        $this->addImagePage($imagesCurrentPage, $pageNumber, $imagesPerPage, $solutions);
        $pageNumber++;

        if ($image->section->book->add_blank_pages) {
          $this->addBlankPage($pageNumber);
          $pageNumber++;
        }

        $imagesCurrentPage = [];
      }
    }

    // Add a final page with the images that are pending.
    if (count($imagesCurrentPage)) {
      $this->addImagePage($imagesCurrentPage, $pageNumber, $imagesPerPage, $solutions);
      $pageNumber++;

      if ($image->section->book->add_blank_pages) {
        $this->addBlankPage($pageNumber);
        $pageNumber++;
      }
    }

    return $pageNumber;
  }


  // Create page with the elements configured in the book
  private function getBookPage($pageNumber)
  {
    $page = new Page($this->bookSettings);

    $pnPosition = $this->bookSettings->getBook()->page_number_position;
    // Add header page number
    if ($pnPosition == config('bookstrap-constants.pageNumberPositions.HEADER')
      || $pnPosition == config('bookstrap-constants.pageNumberPositions.BOTH'))
    {
      $page->setHeaderPageNumber($pageNumber);
    }

    // Add footer page number
    if ($pnPosition == config('bookstrap-constants.pageNumberPositions.FOOTER')
      || $pnPosition == config('bookstrap-constants.pageNumberPositions.BOTH'))
    {
      $page->setFooterPageNumber($pageNumber);
    }

    return $page;
  }

  private function addBlankPage($pageNumber)
  {
    $page = $this->getBookPage($pageNumber);
    $this->pages[] = $page;
  }

  // Create a page with the elements in the book and the title elements
  private function addTitlePage($pageNumber, $solution = false)
  {
    $page = $this->getBookPage($pageNumber);

    // Add section title
    $title = $solution ? $this->currentSection->solutions_title : $this->currentSection->title;

    $page->setSectionTitle($title);

    $this->pages[] = $page;
  }

  private function addImagePage($images, $pageNumber, $imagesPerPage, $solution = false)
  {
    $page = $this->getBookPage($pageNumber);

    // Add header text
    $header = $solution ? $this->currentSection->solutions_header : $this->currentSection->header;
    if (!empty($header)) {
      $page->setHeader($header);
    }

    // Add footer text
    $footer = $this->bookSettings->getBook()->footer_details;
    if (!empty($footer))
    {
      $page->setFooter($footer);
    }

    // Add section image
    $imageTitle = $solution ? $this->currentSection->solutions_name_as_title : $this->currentSection->image_name_as_title;
    $page->setSectionImages($images, $imagesPerPage, $imageTitle);

    $this->pages[] = $page;
  }

  public function getSize()
  {
    return array($this->bookSettings->getBookWidth(), $this->bookSettings->getBookHeight());
  }

  public function getBookPages()
  {
    return $this->pages;
  }

  public function getBookSavePath()
  {
    return $this->bookSettings->getBookFilePath();
  }

  public function getBookDownloadUrl()
  {
    return url($this->bookSettings->getDownloadVirtualPath());
  }
}
