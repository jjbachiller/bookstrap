<?php

namespace App\Book;

use App\Book\DocumentSection;

class DocumentContent {

  private $sections;
  private $imageSize;
  private $imagePosition;

  public function __construct($imageSize = 100, $imagePosition = null) {
    $this->sections = [];
    $this->imageSize = $imageSize;
    $this->imagePosition = $imagePosition ?? config('constants.imagePositions.MIDDLE_CENTER');
  }

  public function configureSections($sections, $workFolder, $documentDimensions) {
    foreach ($sections as $section) {
      $contentFolder = $workFolder . $section['folder'] . '/';
      $mySection = new DocumentSection($section['addTitle'], $section['title'], $section['addTitleHeader'], $contentFolder, $documentDimensions);

      // Apply selected reduction and specified position
      foreach ($mySection->getImages() as $image) {
        list($width, $height) = $this->getReducedImageSize($image);
        $image->setSize($width, $height);
        list($x, $y) = $this->getInDocumentPosition($image, $documentDimensions);
        $image->setPosition($x, $y);
      }

      $this->sections[] = $mySection;
    }
  }

  private function getReducedImageSize($image) {
    list($width, $height) = $image->getSize();

    $reducedWidth = $width * $this->getReducedImagePercentage();
    $reducedHeight = $height * $this->getReducedImagePercentage();

    return array($reducedWidth, $reducedHeight);
  }

  private function getInDocumentPosition($image, $documentDimensions) {
    list($imgWidth, $imgHeight) = $image->getSize();

    switch ($this->getImagePosition()) {
      case config('constants.imagePositions.TOP_LEFT'):
        $x = $documentDimensions->getMarginSide();
        $y = $documentDimensions->getMarginTop();
        break;
      case config('constants.imagePositions.TOP_CENTER'):
        $x = ($documentDimensions->getWidth() - $imgWidth) / 2;
        $y = $documentDimensions->getMarginTop();
        break;
      case config('constants.imagePositions.TOP_RIGHT'):
        $x = $documentDimensions->getWidth() - ($imgWidth + $documentDimensions->getMarginSide());
        $y = $documentDimensions->getMarginTop();
        break;
      case config('constants.imagePositions.MIDDLE_LEFT'):
        $x = $documentDimensions->getMarginSide();
        $y = ($documentDimensions->getHeight() - $imgHeight) / 2;
        break;
      case config('constants.imagePositions.MIDDLE_CENTER'):
        $x = ($documentDimensions->getWidth() - $imgWidth) / 2;
        $y = ($documentDimensions->getHeight() - $imgHeight) / 2;
        break;
      case config('constants.imagePositions.MIDDLE_RIGHT'):
        $x = $documentDimensions->getWidth() - ($imgWidth + $documentDimensions->getMarginSide());
        $y = ($documentDimensions->getHeight() - $imgHeight) / 2;
        break;
      case config('constants.imagePositions.BOTTOM_LEFT'):
        $x = $documentDimensions->getMarginSide();
        $y = $documentDimensions->getHeight() - ($imgHeight + $documentDimensions->getMarginBottom());
        break;
      case config('constants.imagePositions.BOTTOM_CENTER'):
        $x = ($documentDimensions->getWidth() - $imgWidth) / 2;
        $y = $documentDimensions->getHeight() - ($imgHeight + $documentDimensions->getMarginBottom());
        break;
      case config('constants.imagePositions.BOTTOM_RIGHT'):
        $x = $documentDimensions->getWidth() - ($imgWidth + $documentDimensions->getMarginSide());
        $y = $documentDimensions->getHeight() - ($imgHeight + $documentDimensions->getMarginBottom());
        break;
      default:
        $x = $documentDimensions->getMarginSide();
        $y = $documentDimensions->getMarginTop();
    }

    return array($x, $y);
  }

  public function getSections() {
    return $this->sections;
  }

  public function getReducedImagePercentage() {
    return ($this->imageSize / 100);
  }

  public function getImagePosition() {
    return $this->imagePosition;
  }


}
