<?php

namespace App\Bookstrap;

use App\Bookstrap\PageElements\TextElement;
use App\Bookstrap\PageElements\ImageElement;

class Page {

  private $bookSettings;

  private $header;
  private $headerPageNumber;
  private $title;
  private $images;
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

  public function setSectionImages($images, $addTitle=false)
  {
    $this->images = [];

    $moreThanOneImage = count($images) > 1;
    $pageWidth = $this->getPageWidth($moreThanOneImage);
    $pageHeight = $this->getPageHeight($moreThanOneImage);
    list($imgMaxWidth, $imgMaxHeight) = calculateImageMaxDimensions($pageWidth, $pageHeight, count($images));

    foreach ($images as $current => $image) {
      $imgPosition = $current + 1;
      $totalImages = count($images);
      $imageElement = new ImageElement();
      // Set the maximal dimensions and the max init point for the image
      $imageElement->setDimensions($imgMaxWidth, $imgMaxHeight);
      list($offsetX, $offsetY) = calculateImageOffset($totalImages, $imgPosition, $imgMaxWidth, $imgMaxHeight);
      // We add the offset of the content for the document
      $offsetX+= $this->bookSettings->getContentXOffset($moreThanOneImage);
      $offsetY+= $this->bookSettings->getContentYOffset($moreThanOneImage);

      $innerImageOffset = 0;
      // If it have header we added its height to the offset of the content
      if ($this->header) {
        $offsetY+= config('bookstrap-constants.HEADER_HEIGHT');
        // FIXME: Add margin to $offsetY if fullbleed because we haven't
        // add it previously


        // And add an inner margin for the image elements.
        $innerImageOffset = config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT');
      }

      if ($addTitle) {
        // Remove extension from image name
        $imageName = pathinfo($image, PATHINFO_FILENAME);
        $imageTitle = $this->getSectionImageTitle($imageName, $totalImages, $offsetX, $offsetY, $imgMaxWidth);
        $imageElement->setImageTitle($imageTitle);
        // If the image has a title we add the title offset
        $innerImageOffset+= config('bookstrap-constants.IMAGE_TITLE_HEIGHT') + config('bookstrap-constants.ELEMENT_TOP_MARGIN_HEIGHT');
      }
      // Get the scaled image dimensions
      $imgMaxHeightWithOffset = $imgMaxHeight - $innerImageOffset;
      list($scalatedWidth, $scalatedHeight) = scaleToFit($image, $imgMaxWidth, $imgMaxHeightWithOffset);
      // scale Image to the user preferences
      $userScale = $this->getReducedImagePercentage();
      $reducedWidth = $scalatedWidth * $userScale;
      $reducedHeight = $scalatedHeight * $userScale;
      $imageElement->setDimensions($reducedWidth, $reducedHeight);

      // Update the offset adding the inner y offset after the elements added.
      $offsetY+= $innerImageOffset;

      // Set the image alignment into the reserved space.
      list($x, $y) = $this->getInDocumentPosition($reducedWidth, $reducedHeight, $imgMaxWidth, $imgMaxHeightWithOffset, $offsetX, $offsetY);

      $imageElement->setPosition($x, $y);

      $imageElement->setImage($image);

      $this->images[] = $imageElement;
    }
  }

  // If there are more than one image per page, full bleed has no effect.
  private function getPageWidth($moreThanOneImage = false) {
    $fullBleed = $moreThanOneImage ? false : $this->bookSettings->fullBleedImages();
    return $fullBleed ? $this->bookSettings->getBookWidth():$this->bookSettings->getMaxWidth();
  }

  // If there are more than one image per page, full bleed has no effect.
  private function getPageHeight($moreThanOneImage = false) {
    $pageHeight = $this->bookSettings->getBookHeight();
    // We allways substract the margin on the header and footer.
    // Except when fullBleed is selected
    $fullBleed = $moreThanOneImage ? false : $this->bookSettings->fullBleedImages();
    if (!$fullBleed) {
      $pageHeight-= $this->bookSettings->getMargin() * 2;
    }

    if ($this->header) {
      $pageHeight-= config('bookstrap-constants.HEADER_HEIGHT');
    }

    if ($this->footer) {
      $pageHeight-= config('bookstrap-constants.FOOTER_HEIGHT');
    }

    return $pageHeight;
  }

  private function getSectionImageTitle($imageName, $totalImages, $x, $y, $width)
  {
    $imageTitle = new TextElement();

    $imageTitle->setPosition($x, $y);

    $height = config('bookstrap-constants.IMAGE_TITLE_HEIGHT');
    $imageTitle->setDimensions($width, $height);

    $fontSizes = config('bookstrap-constants.IMAGE_TITLE_FONT_SIZES');

    $imageTitle->setTextStyle(
      config('bookstrap-constants.IMAGE_TITLE_FONT'),
      $fontSizes[$totalImages],
      config('bookstrap-constants.IMAGE_TITLE_FONT_STYLE'),
      config('bookstrap-constants.IMAGE_TITLE_ALIGNMENT')
    );

    $imageTitle->setText($imageName);
    return $imageTitle;
  }

  private function getInDocumentPosition($imgWidth, $imgHeight, $maxWidth, $maxHeight, $offsetX, $offsetY) {
    $book = $this->bookSettings->getBook();

    switch ($book->img_position) {
      case config('bookstrap-constants.imagePositions.TOP_LEFT'):
        $x = $offsetX;
        $y = $offsetY;
        break;
      case config('bookstrap-constants.imagePositions.TOP_CENTER'):
        $x = $offsetX + (($maxWidth - $imgWidth) / 2);
        $y = $offsetY;
        break;
      case config('bookstrap-constants.imagePositions.TOP_RIGHT'):
        $x = $offsetX + ($maxWidth - $imgWidth);
        $y = $offsetY;
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_LEFT'):
        $x = $offsetX;
        $y = $offsetY + (($maxHeight - $imgHeight) / 2);
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_CENTER'):
        $x = $offsetX + (($maxWidth - $imgWidth) / 2);
        $y = $offsetY + (($maxHeight - $imgHeight) / 2);
        break;
      case config('bookstrap-constants.imagePositions.MIDDLE_RIGHT'):
        $x = $offsetX + ($maxWidth - $imgWidth);
        $y = $offsetY + (($maxHeight - $imgHeight) / 2);
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_LEFT'):
        $x = $offsetX;
        $y = $offsetY + ($maxHeight - $imgHeight);
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_CENTER'):
        $x = $offsetX + (($maxWidth - $imgWidth) / 2);
        $y = $offsetY + ($maxHeight - $imgHeight);
        break;
      case config('bookstrap-constants.imagePositions.BOTTOM_RIGHT'):
        $x = $offsetX + ($maxWidth - $imgWidth);
        $y = $offsetY + ($maxHeight - $imgHeight);
        break;
      default:
        $x = $offsetX + (($maxWidth - $imgWidth) / 2);
        $y = $offsetY + (($maxHeight - $imgHeight) / 2);
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

  public function getImages()
  {
    return is_null($this->images) ? false : $this->images;
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
