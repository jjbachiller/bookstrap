<?php

namespace App\Book;

use App\Book\DocumentText;
use App\Book\DocumentImage;

class DocumentSection {

  private $showTitle;
  private $title;
  private $header;
  private $images;

  public function __construct($showTitle = false, $title = '', $header = false, $sectionFolder, $documentDimensions) {
    $this->showTitle = $showTitle;
    $this->header = ($header) ? $title : false;
    $this->loadSectionTitle($title, $documentDimensions);
    $this->loadSectionImages($sectionFolder, $documentDimensions);
  }

  private function loadSectionTitle($title, $documentDimensions) {
    $this->title = new DocumentText(
      $title,
      config('constants.TITLE_FONT'),
      config('constants.TITLE_SIZE'),
      config('constants.TITLE_STYLE')
    );
    // Calculate title position: Centered in the page
    if ($documentDimensions->getUnit() == config('constants.PIXEL')) {
      $titleHeight = pointsToPixels(config('constants.TITLE_SIZE'));
    } else {
      $titleHeight = pointsToMM(config('constants.TITLE_SIZE'));
    }

    $x = $documentDimensions->getMarginSide();
    $y = ($documentDimensions->getHeight() - $titleHeight) / 2;
    $this->title->setPosition($x, $y);
    // Calculate title dimensions:
    $titleWidth = $documentDimensions->getMaxWidth();
    $this->title->setSize($titleWidth, $titleHeight);
  }

  private function loadSectionImages($sectionFolder, $documentDimensions) {
    $this->images = [];
    // Create Image content
    $filenames = glob($sectionFolder.'*');
    natsort($filenames);
    foreach ($filenames as $imgFile) {
      $fileinfo = new \SplFileInfo($imgFile);
      if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('constants.allowedExtensions'), true)) continue;

      list($imgWidth, $imgHeight) = $this->getInDocumentSize($imgFile, $documentDimensions);
      $this->images[] = new DocumentImage($imgFile, $imgWidth, $imgHeight);
    }

  }

  private function getInDocumentSize($image, $documentDimensions) {
    list($width, $height) = getimagesize($image);

    if ($documentDimensions->getUnit() == config('constants.MM')) {
      $width = pixelsToMM($width);
      $height = pixelsToMM($height);
    }

    $widthScale = $documentDimensions->getMaxWidth() / $width;
    $heightScale = $documentDimensions->getMaxHeight() / $height;

    $scale = min($widthScale, $heightScale);

    $inDocumentWidth = $scale * $width;
    $inDocumentHeight = $scale * $height;

    return array($inDocumentWidth, $inDocumentHeight);
  }

  public function showTitle() {
    return $this->showTitle;
  }

  public function showTitleAsHeader() {
    return $this->header;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getImages() {
    return $this->images;
  }

}
