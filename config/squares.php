<?php

return [
  's3_folder' => '/maze/square/',
  'puzzles_folder' => '/puzzles/',
  'solutions_folder' => '/solutions/',
  'puzzle_name' => 'Square Maze',
  'solution_name' => 'Solution',
  'ext' => '.png',
  'type' => 'image/png',
  'max_number' => 10000,
  'width' => 828,
  'height' => 828,
  'size' => 120000,
  'difficulties' => [
    'Easy' => 'Easy',
    'Easy_Random' => 'Easy Random',
    'Random_EMD' => 'Random EMD',
  ],
  'addGroups' => [
    10, 25, 50, 100, 150, 200
  ],
];
