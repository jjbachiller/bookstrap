<?php

namespace App\Bookstrap;

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\DocumentLayout;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Font;
use PhpOffice\PhpPresentation\Style\Border;
use App\Bookstrap\MetaBook;

class PPT extends PhpPresentation {

  private $metaBook;

  public function __construct($metaBook) {
    $this->metaBook = $metaBook;

    list($width, $height) = $this->metaBook->getSize();
    parent::__construct($width, $height);
    $layout = $this->getLayout();
    $layout->setCX($width, DocumentLayout::UNIT_MILLIMETER);
    $layout->setCY($height, DocumentLayout::UNIT_MILLIMETER);
  }

  public function generatePPT()
  {
    // Remove the default first slide
    $this->removeSlideByIndex(0);

    $pages = $this->metaBook->getBookPages();

    foreach ($pages as $page) {
      $this->addPageToBook($page);
    }

    return $this->savePPT();
  }

  public function addPageToBook($page) {
    parent::createSlide();
    $this->setActiveSlideIndex($this->getSlideCount()-1);

    $header = $page->getHeader();
    if ($header) {
      $this->addHeader($header);
    }

    $headerPageNumber = $page->getHeaderPageNumber();
    if ($headerPageNumber) {
      $this->addHeaderPageNumber($headerPageNumber);
    }

    $title = $page->getTitle();
    if ($title) {
      $this->addTitle($title);
    }

    $image = $page->getImage();
    if ($image) {
      $this->addImage($image);
    }

    $footer = $page->getFooter();
    if ($footer) {
      $this->addFooter($footer);
    }

    $footerPageNumber = $page->getFooterPageNumber();
    if ($footerPageNumber) {
      $this->addFooterPageNumber($footerPageNumber);
    }
  }

  private function getPPTAlignment($element)
  {
    $alignment = $element->getAlignment();
    switch ($alignment) {
      case 'L':
                return Alignment::HORIZONTAL_LEFT;
      case 'C':
                return Alignment::HORIZONTAL_CENTER;
      case 'R':
                return Alignment::HORIZONTAL_RIGHT;
    }
    return Alignment::HORIZONTAL_CENTER;
  }

  private function addTextElement($element)
  {
    list($x, $y) = $element->getPosition();
    list($width, $height) = $element->getDimensions();

    $currentSlide = $this->getActiveSlide();

    $height = mmToPixels($height);
    $width = mmToPixels($width);
    $x = mmToPixels($x);
    $y = mmToPixels($y);

    $textBlock = $currentSlide->createRichTextShape()
        ->setHeight($height)
        ->setWidth($width)
        ->setOffsetX($x)
        ->setOffsetY($y);

// $textBlock->getBorder()->setLineStyle(Border::LINE_SINGLE)->setDashStyle(Border::DASH_SOLID);//->setColor($colorBlack);

    $alignment = $this->getPPTAlignment($element);
    $textBlock->getActiveParagraph()->getAlignment()->setHorizontal($alignment);
    $textBlock->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    $text = $element->getText();//preprocessText($element->getText());
    $textRun = $textBlock->createTextRun($text);

    $underline = $element->isUnderline() ? Font::UNDERLINE_SINGLE : Font::UNDERLINE_NONE;

    $textRun->getFont($element->getFont())
        ->setBold($element->isBold())
        ->setItalic($element->isItalic())
        ->setUnderline($underline)
        ->setSize($element->getFontSize());
        // ->setColor(new Color('FFE06B20'));
  }

  private function addHeader($header)
  {
    $this->addTextElement($header);

    // Create Bottom Line:
    list($x, $y) = $header->getPosition();
    list($width, $height) = $header->getDimensions();

    $currentSlide = $this->getActiveSlide();

    $lineY = $y + $height;
    $lineWidth = $width + config('bookstrap-constant.PAGENUMBER_WIDTH');
    $currentSlide->createLineShape(mmToPixels($x),mmToPixels($lineY),mmToPixels($lineWidth),mmToPixels($lineY));
  }

  private function addHeaderPageNumber($headerPageNumber)
  {
    $this->addTextElement($headerPageNumber);
  }

  private function addTitle($title)
  {
    $this->addTextElement($title);
  }

  private function addImage($img)
  {
    $imgTitle = $img->getImageTitle();
    if ($imgTitle) {
      // Add image title on the page
      $this->addTextElement($imgTitle);
    }

    $currentSlide = $this->getActiveSlide();
    $shape = $currentSlide->createDrawingShape();

    list($x, $y) = $img->getPosition();
    list($width, $height) = $img->getDimensions();

    $shape->setPath($img->getImage());
    $shape->setWidth(mmToPixels($width));
    $shape->setHeight(mmToPixels($height));
    $shape->setOffsetX(mmToPixels($x));
    $shape->setOffsetY(mmToPixels($y));
  }

  private function addFooter($footer)
  {
    $this->addTextelement($footer);

    // Create Top Line:
    list($x, $y) = $footer->getPosition();
    list($width, $height) = $footer->getDimensions();

    $currentSlide = $this->getActiveSlide();

    $lineY = $y;
    $lineWidth = $width + config('bookstrap-constant.PAGENUMBER_WIDTH');
    $currentSlide->createLineShape(mmToPixels($x),mmToPixels($lineY),mmToPixels($lineWidth),mmToPixels($lineY));
  }

  private function addFooterPageNumber($footerPageNumber)
  {
    $this->addTextElement($footerPageNumber);
  }

  private function savePPT() {
    $output = $this->metaBook->getBookSavePath();
    $output.= config('bookstrap-constants.PPT_EXTENSION');
    $oWriterPPTX = IOFactory::createWriter($this, 'PowerPoint2007');
    $oWriterPPTX->save($output);
    return $output;
  }

}
