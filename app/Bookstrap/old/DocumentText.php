<?php

namespace App\Book;

class DocumentText {

  private $text;
  private $font;
  private $fontSize;
  private $style;
  private $x;
  private $y;
  private $width;
  private $height;

  public function __construct ($text = '', $font = null, $fontSize = null, $style='') {
    $this->text = $text;
    $this->font = $font ?? config('constants.DEFAULT_FONT');
    $this->fontSize = $fontSize ?? config('constants.DEFAULT_FONTSIZE');
    $this->style = $style;
    $this->x = $this->y = 0;
  }

  public function setFont($font) {
    $this->font = $font;
  }

  public function setFontSize($fontSize) {
    $this->fontSize = $fontSize;
  }

  public function setStyle($style) {
    $this->style = $style;
  }

  public function setPosition($x, $y) {
    $this->x = $x;
    $this->y = $y;
  }

  public function setSize($width, $height) {
    $this->width = $width;
    $this->height = $height;
  }

  public function getText() {
    return $this->text;
  }

  public function getFont() {
    return $this->font;
  }

  public function getFontSize()  {
    return $this->fontSize;
  }

  public function getStyle() {
    return $this->style;
  }

  public function getPosition() {
    return array($this->x, $this->y);
  }

  public function getSize() {
    return array($this->width, $this->height);
  }
}
