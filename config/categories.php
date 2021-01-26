<?php

return [

  'itemsPerRow' => 6,

  'iconPath' => 'media/categories/',

  'iconExtension' => '.png',

  'list' =>[
    [
      'name' =>  'Japanese Puzzle',
      'shortname' => 'japanese',
      'subcategories' => [
        [
          'name' => 'Sudokus',
          'shortname' => 'sudoku',
        ],
      ],
    ],
    [
      'name' =>  'Test Puzzle',
      'shortname' => 'test',
      'subcategories' => [ ],
    ],
  ],
];
