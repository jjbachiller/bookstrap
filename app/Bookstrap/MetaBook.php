<?php

namespace App\Bookstrap;

use App\Book;
use App\Bookstrap\BookSettings;
use App\Bookstrap\Page;
use Illuminate\Support\Facades\Storage;

class MetaBook {

  private $bookSettings;
  private $currentSection;
  private $pages;

  public function __construct (Book $book) {
    $this->bookSettings = new BookSettings($book);
    $this->pages = [];
    $this->fillBookPages();
  }

  private function fillBookPages() {
    $pageNumber = 1;
    $book = $this->bookSettings->getBook();
    $sections = $book->sections;

    foreach ($sections as $section)
    {
      $this->currentSection = $section;
      if (!is_null($section->title)) {
        $this->addTitlePage($section, $pageNumber);
        $pageNumber++;

        if ($book->add_blank_pages) {
          $this->addBlankPage($pageNumber);
          $pageNumber++;
        }
      }
      //Get section folder and get sorten images
      // foreach image add a image page and a blank page if this options is selected.
      $sectionFolder = Storage::path($section->getContentFolder());
      $filenames = glob($sectionFolder.'*');
      natsort($filenames);
      foreach ($filenames as $imgFile) {
        $fileinfo = new \SplFileInfo($imgFile);
        if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
        $this->addImagePage($imgFile, $pageNumber);
        $pageNumber++;

        if ($book->add_blank_pages) {
          $this->addBlankPage($pageNumber);
          $pageNumber++;
        }
      }
    }
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
  private function addTitlePage($section, $pageNumber)
  {
    $page = $this->getBookPage($pageNumber);

    // Add section title
    $page->setSectionTitle($section->title);

    $this->pages[] = $page;
  }

  private function addImagePage($image, $pageNumber)
  {
    $page = $this->getBookPage($pageNumber);

    // Add header text
    if ($this->currentSection->header) {
      $page->setHeader($this->currentSection->title);
    }

    // Add section image
    $page->setSectionImage($image, $this->currentSection->image_name_as_title);

    // Add footer text
    $footer = $this->bookSettings->getBook()->footer_details;
    if (!empty($footer))
    {
      $page->setFooter($footer);
    }

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
