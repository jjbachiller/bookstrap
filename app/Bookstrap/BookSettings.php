<?php

namespace App\Bookstrap;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Book;

class BookSettings {
  private $book;
  private $bookWidth;
  private $bookHeight;
  private $marginSide;
  private $bookFolder;
  private $downloadVirtualFolder;

  public function __construct(Book $book)
  {
    $this->book = $book;
    $this->setBookDimensions();
    $this->setBookMargins();
    $this->setDownloadFolders();
  }

  public function setBookDimensions()
  {
    $bookSizes = config('book-sizes');
    $bookSize = $bookSizes[$this->book['dimensions']];
    $this->bookWidth = $bookSize['width'];
    $this->bookHeight = $bookSize['height'];
  }

  // Adjust margin size to the number of pages of the book.
  public function setBookMargins()
  {
    $margins = config('bookstrap-constants.margins');
    foreach ($margins as $margin) {
      if (($this->book->total_pages >= $margin['minPages']) && ($this->book->total_pages <= $margin['maxPages'])) {
        $this->marginSide = $margin['margin'];
        return;
      }
    }
    // If none matched, return the default margin
    $this->marginSide = config('bookstrap-constants.DEFAULT_MARGIN');
  }

  private function setDownloadFolders() {
    $userUid = Auth::check() ? Auth::user()->uid : session('user_uid');

    $currentDate = date('m-d-Y_hia');

    $bookPath = config('bookstrap-constants.downloads_path') . $userUid . '/' . $this->book->uid . '/';
    $bookPath.= $currentDate . '/';
    Storage::makeDirectory($bookPath);
    $this->bookFolder = Storage::path($bookPath);

    $downloadVirtualPath = config('bookstrap-constants.downloads_virtual_path') . $this->book->uid . '/';
    $downloadVirtualPath.= $currentDate . '/';
    // Storage::makeDirectory($downloadVirtualPath);
    $this->downloadVirtualFolder = $downloadVirtualPath;

  }


  public function getBook()
  {
    return $this->book;
  }

  public function fullBleedImages()
  {
    return $this->book->full_bleed;
  }

  public function getMargin()
  {
    return $this->marginSide;
  }

  public function getBookWidth()
  {
    return $this->bookWidth;
  }

  public function getBookHeight()
  {
    return $this->bookHeight;
  }

  public function getMaxWidth() {
    return $this->bookWidth - ($this->marginSide * 2);
  }

  public function getMaxHeight() {
    return $this->bookHeight - ($this->marginSide * 2) - (config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT') * 2) - config('bookstrap-constants.HEADER_HEIGHT') - config('bookstrap-constants.FOOTER_HEIGHT');
  }

  public function getContentXOffset() {
    return $this->fullBleedImages() ? 0 : $this->marginSide;
  }

  public function getContentYOffset() {
    return $this->fullBleedImages() ? 0 : $this->marginSide;
    // return $this->marginSide + config('bookstrap-constants.HEADER_HEIGHT');
  }

  public function getBookFilePath() {
    return $this->bookFolder . $this->book->name;
  }

  public function getDownloadVirtualPath() {
    return $this->downloadVirtualFolder . $this->book->name;
  }
}
