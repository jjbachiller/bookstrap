<?php

namespace App\Bookstrap;

use App\Bookstrap\PageElements\TextElement;
use App\Bookstrap\PageElements\ImageElement;

class Page {

  private $bookSettings;

  private $header;
  private $headerPageNumber;
  private $title;
  private $image;
  private $footer;
  private $footerPageNumber;

  public function __construct($bookSettings) {
    $this->bookSettings = $bookSettings;
  }

  public function setHeader($text)
  {
    $this->header = new TextElement();

    $x = $y = $this->bookSettings->getMargin();
    $this->header->setPosition($x, $y);

    $width = $this->bookSettings->getMaxWidth() - config('bookstrap-constants.PAGENUMBER_WIDTH');
    $height = config('bookstrap-constants.HEADER_HEIGHT');
    $this->header->setDimensions($width, $height);

    $this->header->setTextStyle(
      config('bookstrap-constants.HEADER_FONT'),
      config('bookstrap-constants.HEADER_FONT_SIZE'),
      config('bookstrap-constants.HEADER_FONT_STYLE'),
      config('bookstrap-constants.HEADER_ALIGNMENT')
    );

    $this->header->setText($text);
  }

  public function setHeaderPageNumber($pageNumber)
  {
    $this->headerPageNumber = new TextElement();

    $x = $this->bookSettings->getMargin() + ($this->bookSettings->getMaxWidth() - config('bookstrap-constants.PAGENUMBER_WIDTH'));
    $y = $this->bookSettings->getMargin();
    $this->headerPageNumber->setPosition($x, $y);

    $width = config('bookstrap-constants.PAGENUMBER_WIDTH');
    $height = config('bookstrap-constants.HEADER_HEIGHT');
    $this->headerPageNumber->setDimensions($width, $height);

    $this->headerPageNumber->setTextStyle(
      config('bookstrap-constants.HEADER_FONT'),
      config('bookstrap-constants.HEADER_FONT_SIZE'),
      config('bookstrap-constants.HEADER_FONT_STYLE'),
      config('bookstrap-constants.HEADER_ALIGNMENT')
    );

    $this->headerPageNumber->setText($pageNumber);
  }

  public function setFooter($text)
  {
    $this->footer = new TextElement();

    $x = $this->bookSettings->getMargin();
    $y = $this->bookSettings->getBookHeight() - (config('bookstrap-constants.FOOTER_HEIGHT') + $this->bookSettings->getMargin());
    $this->footer->setPosition($x, $y);

    $width = $this->bookSettings->getMaxWidth() - config('bookstrap-constants.PAGENUMBER_WIDTH');
    $height = config('bookstrap-constants.FOOTER_HEIGHT');
    $this->footer->setDimensions($width, $height);

    $this->footer->setTextStyle(
      config('bookstrap-constants.FOOTER_FONT'),
      config('bookstrap-constants.FOOTER_FONT_SIZE'),
      config('bookstrap-constants.FOOTER_FONT_STYLE'),
      config('bookstrap-constants.FOOTER_ALIGNMENT')
    );

    $this->footer->setText($text);
  }

  public function setFooterPageNumber($pageNumber)
  {
    $this->footerPageNumber = new TextElement();

    $x = $this->bookSettings->getMargin() + ($this->bookSettings->getMaxWidth() - config('bookstrap-constants.PAGENUMBER_WIDTH'));
    $y = $this->bookSettings->getBookHeight() - (config('bookstrap-constants.FOOTER_HEIGHT') + $this->bookSettings->getMargin());
    $this->footerPageNumber->setPosition($x, $y);

    $width = config('bookstrap-constants.PAGENUMBER_WIDTH');
    $height = config('bookstrap-constants.FOOTER_HEIGHT');
    $this->footerPageNumber->setDimensions($width, $height);

    $this->footerPageNumber->setTextStyle(
      config('bookstrap-constants.FOOTER_FONT'),
      config('bookstrap-constants.FOOTER_FONT_SIZE'),
      config('bookstrap-constants.FOOTER_FONT_STYLE'),
      config('bookstrap-constants.FOOTER_ALIGNMENT')
    );

    $this->footerPageNumber->setText($pageNumber);
  }

  public function setSectionTitle($title)
  {
    $this->title = new TextElement();

    $x = $this->bookSettings->getMargin();
    $y = ($this->bookSettings->getBookHeight() - config('bookstrap-constants.TITLE_HEIGHT')) / 2;
    $this->title->setPosition($x, $y);

    $width = $this->bookSettings->getMaxWidth();
    $height = config('bookstrap-constants.TITLE_HEIGHT');
    $this->title->setDimensions($width, $height);

    $this->title->setTextStyle(
      config('bookstrap-constants.TITLE_FONT'),
      config('bookstrap-constants.TITLE_FONT_SIZE'),
      config('bookstrap-constants.TITLE_FONT_STYLE'),
      config('bookstrap-constants.TITLE_ALIGNMENT')
    );

    $this->title->setText($title);
  }

  public function setSectionImage($image)
  {
    $this->image = new ImageElement();

    // Fit image size to document site
    list($width, $height) = $this->scaleToFit($image);
    // scale Image to the user preferences
    $userScale = $this->getReducedImagePercentage();
    $width = $width * $userScale;
    $height = $height * $userScale;

    $this->image->setDimensions($width, $height);

    list($x, $y) = $this->getInDocumentPosition($width, $height);
    $this->image->setPosition($x, $y);

    $this->image->setImage($image);
  }

  // Scale the original image to fit the document size
  private function scaleToFit($image)
  {
      list($width, $height) = getimagesize($image);

      $width = pixelsToMM($width);
      $height = pixelsToMM($height);

      $widthScale = $this->bookSettings->getMaxWidth() / $width;
      $heightScale = $this->bookSettings->getMaxHeight() / $height;

      $scale = min($widthScale, $heightScale);

      $inDocumentWidth = $scale * $width;
      $inDocumentHeight = $scale * $height;

      return array($inDocumentWidth, $inDocumentHeight);
  }

  private function getInDocumentPosition($imgWidth, $imgHeight) {
    $book = $this->bookSettings->getBook();
    switch ($book->img_position) {
      case config('bookstrap-constants.imagePositions.TOP_LEFT'):
        $x = $this->bookSettings->getMargin();
        $y = $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT');
        break;
      case config('bookstrap-constants.imagePositions.TOP_CENTER'):
        $x = ($this->bookSettings->getBookWidth() - $imgWidth) / 2;
        $y = $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT');
        break;
      case config('bookstrap-constants.imagePositions.TOP_RIGHT'):
        $x = $this->bookSettings->getBookWidth() - ($imgWidth + $this->bookSettings->getMargin());
        $y = $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT');
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_LEFT'):
        $x = $this->bookSettings->getMargin();
        $y = ($this->bookSettings->getBookHeight() - $imgHeight) / 2;
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_CENTER'):
        $x = ($this->bookSettings->getBookWidth() - $imgWidth) / 2;
        $y = ($this->bookSettings->getBookHeight() - $imgHeight) / 2;
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_RIGHT'):
        $x = $this->bookSettings->getBookWidth() - ($imgWidth + $this->bookSettings->getMargin());
        $y = ($this->bookSettings->getBookHeight() - $imgHeight) / 2;
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_LEFT'):
        $x = $this->bookSettings->getMargin();
        $y = $this->bookSettings->getBookHeight() - ($imgHeight + $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT'));
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_CENTER'):
        $x = ($this->bookSettings->getBookWidth() - $imgWidth) / 2;
        $y = $this->bookSettings->getBookHeight() - ($imgHeight + $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT'));
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_RIGHT'):
        $x = $this->bookSettings->getBookWidth() - ($imgWidth + $this->bookSettings->getMargin());
        $y = $this->bookSettings->getBookHeight() - ($imgHeight + $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT'));
        break;
      default:
        $x = $this->bookSettings->getMargin();
        $y = $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT');;
    }

    return array($x, $y);
  }

  private function getReducedImagePercentage() {
    $book = $this->bookSettings->getBook();
    return ($book->img_scale / 100);
  }

  public function getHeader()
  {
    return is_null($this->header) ? false : $this->header;
  }

  public function getHeaderPageNumber()
  {
    return is_null($this->headerPageNumber) ? false : $this->headerPageNumber;
  }

  public function getTitle()
  {
    return is_null($this->title) ? false : $this->title;
  }

  public function getImage()
  {
    return is_null($this->image) ? false : $this->image;
  }

  public function getFooter()
  {
    return is_null($this->footer) ? false : $this->footer;
  }

  public function getFooterPageNumber()
  {
    return is_null($this->footerPageNumber) ? false : $this->footerPageNumber;
  }

}
