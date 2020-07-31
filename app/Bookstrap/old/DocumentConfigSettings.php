<?php

namespace App\Book;

use App\Book\DocumentDimensions;
use App\Book\DocumentFile;
use App\Book\DocumentContent;
use App\Book\DocumentMetaSection;

class DocumentConfigSettings {

  private $dimensions;
  private $documentFile;
  private $content;
  private $header;
  private $footer;
  private $copyright;


  private $addBlankPages;
  private $showCopyright;
  private $copyrightText;

  public function __construct($configuration) {

    $bookSizes = config('book-sizes');
    $bookSize = $bookSizes[$configuration['size']];
    $unit = ($configuration['filetype'] == config('constants.PDF')) ? config('constants.MM') : config('constants.PIXEL');
    $this->dimensions = new DocumentDimensions($bookSize['width'], $bookSize['height'], $configuration['totalPages'], $unit);


    $this->documentFile = new DocumentFile($configuration['book'], $configuration['filename'], $configuration['filetype']);
    $this->content = new DocumentContent($configuration['imageSize'], $configuration['imagePosition'], $this->dimensions);
    $this->content->configureSections($configuration['sections'], $this->documentFile->getWorkFolder(), $this->dimensions);

    $this->addBlankPages = $configuration['addBlankPages'];

    // $this->configurePageCopyright($configuration['copyright']);
    $this->configurePageHeader();
    $this->configurePageFooter($configuration['footer']);

    if ($configuration['pageNumber']['addPageNumber']) {
      $this->configurePageNumber($configuration['pageNumber']['position']);
    } else {
      // You have to specify the pageNumber even if it's false, in order to set the correct dimensions.
      $this->header->setShowPageNumber(false, $this->dimensions->getUnit());
      $this->footer->setShowPageNumber(false, $this->dimensions->getUnit());
    }

  }

  private function configurePageHeader() {
    $this->header = new DocumentMetaSection();
    $this->header->getDocumentText()->setFont(config('constants.HEADER_FONT'));
    $this->header->getDocumentText()->setFontSize(config('constants.HEADER_SIZE'));
    $this->header->getDocumentText()->setStyle(config('constants.HEADER_STYLE'));

    if ($this->dimensions->getUnit() == config('constants.PIXEL')) {
      $height = pointsToPixels(config('constants.HEADER_SIZE'));
    } else {
      $height = pointsToMM(config('constants.HEADER_SIZE'));
    }
    $width = $this->dimensions->getMaxWidth();
    $this->header->getDocumentText()->setSize($width, $height);

    $x = $y = $this->dimensions->getMarginSide();
    $this->header->getDocumentText()->setPosition($x, $y);

  }

  private function configurePageFooter($footer) {
    $this->footer = new DocumentMetaSection($footer['addFooter'], $footer['text']);
    $this->footer->getDocumentText()->setFont(config('constants.FOOTER_FONT'));
    $this->footer->getDocumentText()->setFontSize(config('constants.FOOTER_SIZE'));
    $this->footer->getDocumentText()->setStyle(config('constants.FOOTER_STYLE'));

    $pageNumberWidth = config('constants.PAGENUMBER_WIDTH_IN_MM');
    if ($this->dimensions->getUnit() == config('constants.PIXEL')) {
      $height = pointsToPixels(config('constants.FOOTER_SIZE'));
      $pageNumberWidth = mmToPixels($pageNumberWidth);
    } else {
      $height = pointsToMM(config('constants.FOOTER_SIZE'));
    }
    $width = $this->dimensions->getMaxWidth();
    $this->footer->getDocumentText()->setSize($width, $height);

    $x = $this->dimensions->getMarginSide();
    $y = $this->dimensions->getHeight() - ($height + $this->dimensions->getMarginSide());
    $this->footer->getDocumentText()->setPosition($x, $y);

  }
  //
  // private function configurePageCopyright($copyright) {
  //   $this->copyright = new DocumentMetaSection($copyright['addCopyright'], $copyright['text']);
  //   $this->copyright->getDocumentText()->setFont(config('constants.COPYRIGHT_FONT'));
  //   $this->copyright->getDocumentText()->setFontSize(config('constants.COPYRIGHT_SIZE'));
  //   $this->copyright->getDocumentText()->setStyle(config('constants.COPYRIGHT_STYLE'));
  //
  //   if ($this->dimensions->getUnit() == config('constants.PIXEL')) {
  //     $height = pointsToPixels(config('constants.FOOTER_SIZE'));
  //   } else {
  //     $height = pointsToMM(config('constants.FOOTER_SIZE'));
  //   }
  //   $numLines = substr_count( $copyright['text'], "\n" ) + 1;
  //   // FIXME: Guess Multicell interlined in order to get a good multiplier and not 3.5 hardcoded
  //   $height = $height * ($numLines * 3.5);
  //
  //   $width = $this->dimensions->getMaxWidth();
  //   $this->copyright->getDocumentText()->setSize($width, $height);
  //
  //   $x = $this->dimensions->getMarginSide();
  //   $y = $this->dimensions->getHeight() - ($height + $this->dimensions->getMarginSide());
  //   $this->copyright->getDocumentText()->setPosition($x, $y);
  //
  // }

  private function configurePageNumber($pageNumberPosition) {
    $headerPageNumber = ($pageNumberPosition == config('constants.pageNumberPositions.HEADER') ||
                        $pageNumberPosition == config('constants.pageNumberPositions.BOTH'));
    $this->header->setShowPageNumber($headerPageNumber, $this->dimensions->getUnit());

    $footerPageNumber = ($pageNumberPosition == config('constants.pageNumberPositions.FOOTER') ||
                        $pageNumberPosition == config('constants.pageNumberPositions.BOTH'));
    $this->footer->setShowPageNumber($footerPageNumber, $this->dimensions->getUnit());
  }

  public function getSize() {
    return array($this->dimensions->getWidth(), $this->dimensions->getHeight());
  }

  public function getSections() {
    return $this->content->getSections();
  }

  public function getCopyright() {
    return $this->copyright;
  }

  public function getHeader() {
    return $this->header;
  }

  public function getFooter() {
    return $this->footer;
  }

  public function showBlankPages() {
    return $this->addBlankPages;
  }

  public function getFileType() {
    return $this->documentFile->getFiletype();
  }

  public function getBookSavePath() {
    return $this->documentFile->getBookFilePath();
  }

  public function getBookDownloadUrl() {
    return url($this->documentFile->getDownloadVirtualPath());
  }

}
