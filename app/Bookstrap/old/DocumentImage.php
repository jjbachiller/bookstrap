<?php

namespace App\Book;

class DocumentImage {

  private $imageFile;
  private $x;
  private $y;
  private $width;
  private $height;

  public function __construct($imageFile, $width, $height) {
    $this->imageFile = $imageFile;
    $this->width = $width;
    $this->height = $height;
    $this->x = $this->y = 0;
  }

  public function setPosition($x, $y) {
    $this->x = $x;
    $this->y = $y;
  }

  public function setSize($width, $height) {
    $this->width = $width;
    $this->height = $height;
  }

  public function getImageFile() {
    return $this->imageFile;
  }

  public function getPosition() {
    return array($this->x, $this->y);
  }

  public function getSize() {
    return array($this->width, $this->height);
  }

}
