<?php

return [
  'INCH_IN_MM' => 25.4,
  'POINT_IN_PIXELS' => 1.33,
  'POINT_IN_MM' => 0.35,
  'DPI' => 96,
  'A4_HEIGHT' => 228.6,
  'A4_WIDTH' => 152.4,
  'uploads_path' => 'uploads/',
  'content_virtual_path' => 'content/',
  'book_virtual_path' => 'book/',
  'downloads_path' => 'downloads/',
  'allowedExtensions' => ['jpg', 'png', 'gif'],
  'pageNumberPositions' => [
    'HEADER' => 1,
    'FOOTER' => 2,
    'BOTH' => 3
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
  'pageTypes' => [
    'BLANK' => 1,
    'TITLE' => 2,
    'IMAGE' => 3,
  ],
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
  'DEFAULT_MARGIN_IN_MM' => 12.7, // In mm.
  'HEADER_HEIGHT_IN_MM' => 15,
  'FOOTER_HEIGHT_IN_MM' => 15,
  'PDF_ORIENTATION' => 'P', // Portrait
  'PDF_UNIT' => 'mm',
  'PDF' => 1,
  'PPT' => 2,
  'PDF_EXTENSION' => '.pdf',
  'PPT_EXTENSION' => '.pptx',
  'DEFAULT_FILENAME' => 'mybook',
  'PIXEL' => 1,
  'MM' => 2,
  'IMAGE_UNIT_PIXEL' => 1,
  'IMAGE_UNIT_MM' => 2,
  'PAGENUMBER_WIDTH_IN_MM' => 15,

  'HEADER_FONT' => 'Arial',
  'HEADER_SIZE' => 11,
  'HEADER_STYLE' => 'I',

  'FOOTER_FONT' => 'Arial',
  'FOOTER_SIZE' => 11,
  'FOOTER_STYLE' => 'I',

  'COPYRIGHT_FONT' => 'Arial',
  'COPYRIGHT_SIZE' => 8,
  'COPYRIGHT_STYLE' => '',

  'TITLE_FONT' => 'Arial',
  'TITLE_SIZE' => 30,
  'TITLE_STYLE' => 'BU',

  'DEFAULT_FONT' => 'Arial',
  'DEFAULT_FONTSIZE' => 11,

  'COPYRIGHT_TEXT' => '[BOOK_TITLE] by [BOOK_AUTHOR] Published by [BOOK_PUBLISHER]
www.[WEBSITE]
© ' . date("Y") . ' [BOOK_AUTHOR]
All rights reserved. No portion of this book may be reproduced in any form without permission from the publisher, except as permitted by U.S. copyright law. For permissions contact:
@[E-MAIL]
Cover by [COVER_AUTHOR].
book ISBN: [BOOK_ISBN]'
];
