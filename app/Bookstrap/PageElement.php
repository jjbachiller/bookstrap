<?php

namespace App\Bookstrap;

class PageElement {

  private $x;
  private $y;
  private $width;
  private $height;

  public function setPosition($x, $y)
  {
    $this->x = $x;
    $this->y = $y;
  }

  public function setDimensions($width, $height)
  {
    $this->width = $width;
    $this->height = $height;
  }

  public function getPosition()
  {
    return array($this->x, $this->y);
  }

  public function getDimensions()
  {
    return array($this->width, $this->height);
  }

}
