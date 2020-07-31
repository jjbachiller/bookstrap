<?php

namespace App\Book;

class DocumentDimensions {

  private $unit;
  private $width;
  private $height;
  private $marginSide;
  private $marginTop;
  private $marginBottom;

  public function __construct ($width = null, $height = null, $totalPages = 0, $unit = null) {
    $this->unit = $unit ?? config('constants.MM');
    $this->height = isset($height) ? round(config('constants.INCH_IN_MM') * $height, 1) : config('constants.A4_HEIGHT');
    $this->width = isset($width) ? round(config('constants.INCH_IN_MM') * $width, 1) : config('constants.A4_WIDTH');
    $margin = $this->calculateMarginForBookPages($totalPages);
    $this->marginSide = $margin;
    $this->marginTop = $margin + config('constants.HEADER_HEIGHT_IN_MM');
    $this->marginBottom = $margin + config('constants.FOOTER_HEIGHT_IN_MM');

    if ($this->unit == config('constants.PIXEL')) {
      $this->height = mmToPixels($this->height);
      $this->width = mmToPixels($this->width);
      $this->marginSide = mmToPixels($this->marginSide);
      $this->marginTop = mmToPixels($this->marginTop);
      $this->marginBottom = mmToPixels($this->marginBottom);
    }

  }

  // Return the right margin (in MM) for the book number of pages as in the Amazon KDP specifications
  private function calculateMarginForBookPages($totalPages) {
    $margins = config('constants.margins');
    foreach ($margins as $margin) {
      if (($totalPages >= $margin['minPages']) && ($totalPages <= $margin['maxPages'])) {
        return $margin['margin'];
      }
    }
    // If none matched, return the default margin
    return config('constants.DEFAULT_MARGIN_IN_MM');
  }

  public function getUnit() {
    return $this->unit;
  }

  public function getWidth() {
    return $this->width;
  }

  public function getHeight() {
    return $this->height;
  }

  public function getMarginSide() {
    return $this->marginSide;
  }

  public function getMarginTop() {
    return $this->marginTop;
  }

  public function getMarginBottom() {
    return $this->marginBottom;
  }

  public function getMaxWidth() {
    $maxWidth = $this->width - ($this->marginSide * 2);
    return $this->width - ($this->marginSide * 2);
  }

  public function getMaxHeight() {
    return $this->height - ($this->marginTop + $this->marginBottom);
  }

}
