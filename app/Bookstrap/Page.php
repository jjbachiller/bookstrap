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

  public function setSectionImage($image, $addTitle=false)
  {
    $this->image = new ImageElement();

    // If it's not wanted we can save space arround image title only (double of this)
    // Then we have to initialize here to 0 and add twice if ($addTitle)
    $startY = config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT');

    if ($addTitle) {
      // Remove extension from image name
      $imageName = pathinfo($image, PATHINFO_FILENAME);
      $imageTitle = $this->getSectionImageTitle($imageName);
      $this->image->setImageTitle($imageTitle);
      $startY+= config('bookstrap-constants.IMAGE_TITLE_HEIGHT') + config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT');
    }

    // Fit image size to document site
    list($width, $height) = $this->scaleToFit($image, $startY);
    // scale Image to the user preferences
    $userScale = $this->getReducedImagePercentage();
    $width = $width * $userScale;
    $height = $height * $userScale;

    $this->image->setDimensions($width, $height);

    list($x, $y) = $this->getInDocumentPosition($width, $height, $startY);
    $this->image->setPosition($x, $y);

    $this->image->setImage($image);
  }

  private function getSectionImageTitle($imageName)
  {
    $imageTitle = new TextElement();

    $x = $this->bookSettings->getMargin();
    $y = $this->bookSettings->getMargin() + config('bookstrap-constants.HEADER_HEIGHT') + config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT');
    $imageTitle->setPosition($x, $y);

    $width = $this->bookSettings->getMaxWidth();
    $height = config('bookstrap-constants.IMAGE_TITLE_HEIGHT');
    $imageTitle->setDimensions($width, $height);

    $imageTitle->setTextStyle(
      config('bookstrap-constants.IMAGE_TITLE_FONT'),
      config('bookstrap-constants.IMAGE_TITLE_FONT_SIZE'),
      config('bookstrap-constants.IMAGE_TITLE_FONT_STYLE'),
      config('bookstrap-constants.IMAGE_TITLE_ALIGNMENT')
    );

    $imageTitle->setText($imageName);
    return $imageTitle;
  }

  // Scale the original image to fit the document size
  private function scaleToFit($image, $startY)
  {
      list($width, $height) = getimagesize($image);

      $width = pixelsToMM($width);
      $height = pixelsToMM($height);

      $widthScale = $this->bookSettings->getMaxWidth() / $width;
      $heightScale = ($this->bookSettings->getMaxHeight() - $startY) / $height;

      $scale = min($widthScale, $heightScale);

      $inDocumentWidth = $scale * $width;
      $inDocumentHeight = $scale * $height;

      return array($inDocumentWidth, $inDocumentHeight);
  }


  private function getInDocumentPosition($imgWidth, $imgHeight, $startY) {
    $book = $this->bookSettings->getBook();

    // Height of the section where the image can be allocated
    $imageSectionHeight = $this->bookSettings->getBookHeight() - $startY;

    $topStartY = $startY + $this->bookSettings->getMargin();

    // Image Y coordinate on bottom allignment
    // Last Y point in the document.
    $bottomStartY = $this->bookSettings->getBookHeight();
    // Up Y the height of the image
    $bottomStartY-= $imgHeight;
    // Up Y the margin of the document
    $bottomStartY-= $this->bookSettings->getMargin();
    // Up Y the footer Height.
    $bottomStartY-= config('bookstrap-constants.FOOTER_HEIGHT');
    // Up Y the margin top of the footer.
    $bottomStartY-= config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT');

    switch ($book->img_position) {
      case config('bookstrap-constants.imagePositions.TOP_LEFT'):
        $x = $this->bookSettings->getMargin();
        $y = $topStartY + config('bookstrap-constants.HEADER_HEIGHT');
        break;
      case config('bookstrap-constants.imagePositions.TOP_CENTER'):
        $x = ($this->bookSettings->getBookWidth() - $imgWidth) / 2;
        $y = $topStartY + config('bookstrap-constants.HEADER_HEIGHT');
        break;
      case config('bookstrap-constants.imagePositions.TOP_RIGHT'):
        $x = $this->bookSettings->getBookWidth() - ($imgWidth + $this->bookSettings->getMargin());
        $y = $topStartY + config('bookstrap-constants.HEADER_HEIGHT');
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_LEFT'):
        $x = $this->bookSettings->getMargin();
        $y = (($imageSectionHeight - $imgHeight) / 2); + $startY;
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_CENTER'):
        $x = ($this->bookSettings->getBookWidth() - $imgWidth) / 2;
        $y = (($imageSectionHeight - $imgHeight) / 2) + $startY;
        // print_r("X: " . $x . " Y: " . $y);
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_RIGHT'):
        $x = $this->bookSettings->getBookWidth() - ($imgWidth + $this->bookSettings->getMargin());
        $y = (($imageSectionHeight - $imgHeight) / 2) + $startY;
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_LEFT'):
        $x = $this->bookSettings->getMargin();
        $y = $bottomStartY;
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_CENTER'):
        $x = ($this->bookSettings->getBookWidth() - $imgWidth) / 2;
        $y = $bottomStartY;
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_RIGHT'):
        $x = $this->bookSettings->getBookWidth() - ($imgWidth + $this->bookSettings->getMargin());
        $y = $bottomStartY;
        break;
      default:
        $x = $this->bookSettings->getMargin();
        $y = $startY + config('bookstrap-constants.HEADER_HEIGHT');
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
