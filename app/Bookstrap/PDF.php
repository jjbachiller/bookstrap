<?php

namespace App\Bookstrap;

use App\Classes\PDF_ImageAlpha;
use App\Bookstrap\MetaBook;

class PDF extends PDF_ImageAlpha {

    private $metaBook;
    private $previousPage;
    private $currentPage;

    public function __construct($metaBook) {
      $this->metaBook = $metaBook;
      $size = $this->metaBook->getSize();
      parent::__construct(config('bookstrap-constants.PDF_ORIENTATION'), config('bookstrap-constants.PDF_UNIT'), $size);
    }

    public function generatePDF()
    {

      $pages = $this->metaBook->getBookPages();

      foreach ($pages as $page) {
        $this->previousPage = $this->currentPage ?? $page;
        $this->currentPage = $page;
        $this->addPageToBook();
      }
      // For close with the correct footer in the last page.
      $this->previousPage = $this->currentPage;

      return $this->savePDF();
    }

    private function addPageToBook()
    {
      $this->AddPage();

      $title = $this->currentPage->getTitle();
      if ($title) {
        $this->addTitle($title);
      }

      $images = $this->currentPage->getImages();
      if ($images) {
        $this->addImages($images);
      }

    }

    private function getPDFStyle($element)
    {
      $style = '';
      if ($element->isBold()) $style.='B';
      if ($element->isItalic()) $style.='I';
      if ($element->isUnderline()) $style.='U';
      return $style;
    }

    private function addTextElement($element, $multiCell = false, $line = 0, $middleTo = false)
    {
      $style = $this->getPDFStyle($element);
      $this->SetFont($element->getFont(), $style, $element->getFontSize());

      list($x, $y) = $element->getPosition();
      list($width, $height) = $element->getDimensions();

      // Calculate the center of the space between the image and the header
      if ($middleTo) {
        // If we like to center title in the middle of a space between the tittle Y
        // And a higher Y: For example the start of image Y
        $y += (($middleTo - $y - $height) / 2);
      }

      $this->SetXY($x,$y);


      $text = preprocessText($element->getText());
      $alignment = $element->getAlignment();
      if ($multiCell) {
        $this->Multicell($width, $height, $text, 0, $alignment);
      } else {
        $this->Cell($width, $height, $text, $line, 0, $alignment);
      }
    }

    private function addTitle($title)
    {
      $this->addTextElement($title, true);
    }

    private function addImages($images)
    {
      foreach ($images as $img) {
        list($x, $y) = $img->getPosition();

        $imgTitle = $img->getImageTitle();
        if ($imgTitle) {
          // Add image title on the page
          $this->addTextElement($imgTitle, false, 0, $y);
        }

        list($width, $height) = $img->getDimensions();
        $image = $img->getImage();
        $this->Image(
          $image->fullPath(),
          $x, $y,
          $width, $height
        );
      }
    }

    public function Header()
    {
      if (is_null($this->currentPage)) return;

      $header = $this->currentPage->getHeader();

      if ($header) {
        $this->addTextElement($header, false, 'B');
      }

      $headerPageNumber = $this->currentPage->getHeaderPageNumber();
      if ($headerPageNumber) {
        $this->addTextElement($headerPageNumber);
      }
    }

    public function Footer()
    {
      if (is_null($this->previousPage)) return;

      $footer = $this->previousPage->getFooter();

      if ($footer) {
        $this->addTextElement($footer, false, 'T');
      }

      $footerPageNumber = $this->previousPage->getFooterPageNumber();
      if ($footerPageNumber) {
        $this->addTextElement($footerPageNumber);
      }
    }

    private function savePDF() {
      $output = $this->metaBook->getBookSavePath();
      $output.= config('bookstrap-constants.PDF_EXTENSION');
      $this->Output($output, 'F');
      return $output;
    }
}
