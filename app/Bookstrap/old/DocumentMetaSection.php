<?php

namespace App\Book;

use App\Book\DocumentText;

class DocumentMetaSection {

  private $showText;
  private $showPageNumber;
  private $pageNumberX;
  private $pageNumberWidth;
  private $documentText;

  public function __construct($showText = false, $text = '', $showPageNumber = false) {
    $this->showText = $showText;
    $this->showPageNumber = $showPageNumber;
    $this->documentText = new DocumentText($text);
  }

  public function getDocumentText() {
    return $this->documentText;
  }

  public function getText() {
    return $this->showText ? $this->documentText->getText() : false;
  }

  public function setShowPageNumber($showPageNumber, $unit) {
    $this->showPageNumber = $showPageNumber;
    // Specify the pagenumber text box attribute and resize the metasection attributes
    if ($this->showPageNumber) {
      // Specify the pagenumber box width
      $pageNumberWidth = config('constants.PAGENUMBER_WIDTH_IN_MM');
      if ($unit == config('constants.PIXEL')) {
        $this->pageNumberWidth = mmToPixels($pageNumberWidth);
      }
      // Resize de Section to left space to the pagenumber box
      list($sectionWidth, $sectionHeight) = $this->documentText->getSize();
      $sectionWidth = $sectionWidth - $this->pageNumberWidth;

      // $this->documentText->setSize($sectionWidth, $sectionHeight);

      // Specify the pageNumber X position.
      list($sectionX, $sectionY) = $this->documentText->getPosition();
      $this->pageNumberX = $sectionX + $sectionWidth;
    }
  }

  public function showPageNumber() {
    return $this->showPageNumber;
  }

  public function getSize() {
    return array(100, 100);
  }

  public function getPosition() {
    return array(0, 0);
  }

  public function getPageNumberWidth() {
    return $this->pageNumberWidth;
  }

  public function getPageNumberX() {
    return $this->pageNumberX;
  }

}
