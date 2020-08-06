<?php

namespace App\Bookstrap\PageElements;

use App\Bookstrap\PageElement;
use App\Bookstrap\PageElements\TextElement;

class ImageElement extends PageElement {

  private $image;
  private $imageTitle;

  public function setImage($image)
  {
    $this->image = $image;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function setImageTitle($imageTitle)
  {
    $this->imageTitle = $imageTitle;
  }

  public function getImageTitle()
  {
    return $this->imageTitle;
  }
}
