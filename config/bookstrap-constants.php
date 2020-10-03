<?php
// Measurements in mm
return [
  'INCH_IN_MM' => 25.4,
  'DPI' => 96,
  'allowedExtensions' => ['jpg', 'png', 'gif'],
  'margins' => [
    0 => [
      'minPages' => 0,
      'maxPages' => 300,
      'margin' => 12.7,
    ],
    1 => [
      'minPages' => 301,
      'maxPages' => 500,
      'margin' => 15.9,
    ],
    2 => [
      'minPages' => 501,
      'maxPages' => 700,
      'margin' => 19.1,
    ],
    3 => [
      'minPages' => 701,
      'maxPages' => 828,
      'margin' => 22.3,
    ],
  ],
  'DEFAULT_MARGIN' => 12.7,
  'uploads_path' => 'uploads/',
  'uploads_virtual_path' => 'content/',
  'downloads_path' => 'downloads/',
  'downloads_virtual_path' => 'book/',
  'SOLUTIONS_FOLDER' => 'solutions/',
  'pageNumberPositions' => [
    'HEADER' => 1,
    'FOOTER' => 2,
    'BOTH' => 3
  ],
  'sectionTitle' => [
    'PAGE' => 1,
    'HEADER' => 2,
    'PAGE_AND_HEADER' => 3,
  ],
  'imagePositions' => [
    'TOP_LEFT' => 1,
    'TOP_CENTER' => 2,
    'TOP_RIGHT' => 3,
    'MIDDLE_LEFT' => 4,
    'MIDDLE_CENTER' => 5,
    'MIDDLE_RIGHT' => 6,
    'BOTTOM_LEFT' => 7,
    'BOTTOM_CENTER' => 8,
    'BOTTOM_RIGHT' => 9
  ],
  'miniatures' => [
    'original' => [
      'folder' => '',
      'width' => 0,
      'height' => 0,
    ],
    // 'uploader' => [
    //   'folder' => 'uploader/',
    //   'width' => 120,
    //   'height' => 120,
    // ],
    'preview' => [
      'folder' => 'preview/',
      'width' => 380,
      'height' => 355,
    ]
  ],
  'PAGENUMBER_WIDTH' => 15,

  'HEADER_HEIGHT' => 5,
  'HEADER_FONT' => 'Arial',
  'HEADER_FONT_SIZE' => 11,
  'HEADER_FONT_STYLE' => 'I',
  'HEADER_ALIGNMENT' => 'L',

  'FOOTER_HEIGHT' => 5,
  'FOOTER_FONT' => 'Arial',
  'FOOTER_FONT_SIZE' => 11,
  'FOOTER_FONT_STYLE' => 'I',
  'FOOTER_ALIGNMENT' => 'L',

  'TITLE_HEIGHT' => 40,
  'TITLE_FONT' => 'Arial',
  'TITLE_FONT_SIZE' => 30,
  'TITLE_FONT_STYLE' => 'BU',
  'TITLE_ALIGNMENT' => 'C',

  'IMAGE_TITLE_HEIGHT' => 8,
  'IMAGE_TITLE_FONT' => 'Arial',
  'IMAGE_TITLE_FONT_STYLE' => 'BU',
  'IMAGE_TITLE_ALIGNMENT' => 'C',
  'IMAGE_TITLE_FONT_SIZES' => [
    1 => 25,
    2 => 20,
    3 => 18,
    4 => 18,
    5 => 16,
    6 => 16,
    7 => 16,
    8 => 16,
    9 => 12,
    10 => 12,
    11 => 12,
    12 => 12,
  ],
  'ELEMENT_TOP_MARGIN_HEIGHT' => 1,

  'PDF_UNIT' => 'mm',
  'PDF_ORIENTATION' => 'P',
  'PDF' => 1,
  'PPT' => 2,
  'PDF_EXTENSION' => '.pdf',
  'PPT_EXTENSION' => '.pptx',
  'PDF_CONTENT_TYPE' => 'application/pdf';
  'PPT_CONTENT_TYPE' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
  'NUM_BOOKS_PAGINATION' => 10,
  'NUM_IMAGES_PRELOADED' => 2,
];
