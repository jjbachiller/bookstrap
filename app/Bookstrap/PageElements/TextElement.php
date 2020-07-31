<?php

namespace App\Bookstrap\PageElements;

use App\Bookstrap\PageElement;

class TextElement extends PageElement {

  private $font;
  private $fontSize;
  private $bold;
  private $italic;
  private $underline;
  private $alignment;
  private $text;

  // style: "BIU": Bold,Italic,Underline | alignment: L,C,R: Left, Center or Right
  public function setTextStyle($font, $fontSize, $style, $alignment)
  {
    $this->font = $font;
    $this->fontSize = $fontSize;
    $this->bold = (strpos($style, 'B') !== false) ? true : false;
    $this->italic = (strpos($style, 'I') !== false) ? true : false;
    $this->underline = (strpos($style, 'U') !== false) ? true : false;
    $this->alignment = $alignment;
  }

  public function setText($text)
  {
    $this->text = $text;
  }

  public function getFont()
  {
    return $this->font;
  }

  public function getFontSize()
  {
    return $this->fontSize;
  }

  public function isBold()
  {
    return $this->bold;
  }

  public function isItalic()
  {
    return $this->italic;
  }

  public function isUnderline()
  {
    return $this->underline;
  }

  public function getAlignment()
  {
    return $this->alignment;
  }

  public function getText()
  {
    return $this->text;
  }
}
