<?php

namespace App\Bookstrap\PageElements;

use App\Bookstrap\PageElement;

class ImageElement extends PageElement {

  private $image;

  public function setImage($image)
  {
    $this->image = $image;
  }

  public function getImage()
  {
    return $this->image;
  }

}
