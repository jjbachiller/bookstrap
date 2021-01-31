<?php

return [

  'itemsPerRow' => 6,

  'iconPath' => 'media/categories/',

  'iconExtension' => '.png',

  'list' =>[

    // Japanese Puzzle Category
  
    'japanese' =>
      [
        'name' =>  'Japanese Puzzle',
        'shortname' => 'japanese',

        'subcategories' => [

          //
          'akari' => 
            [
              'name' => 'Akari',
              'shortname' => 'akari',

              'difficulties' => [
                '8x8-Grid1-D1' => '8x8 Grid 1',
                '8x8-Grid2-D1' => '8x8 Grid 2',
                '10x10-Grid3-D1' => '10x10 Grid 3',
              ],

            ],

          //
          'domino' =>
            [
              'name' => 'Domino',
              'shortname' => 'domino',

               'difficulties' => [
                 'size3' => 'Size 3',
                 'size4' => 'Size 4',
                 'size5' => 'Size 5',
               ],

            ],

          //
          'fillomino' =>
            [
              'name' => 'Fillomino',
              'shortname' => 'fillomino',

               'difficulties' => [
                 '5x5' => '5x5 Grid',
                 '6x6' => '6x6 Grid',
                 '7x7' => '7x7 Grid',
                 '8x8' => '8x8 Grid',
               ],

            ],

          //
          'futoshiki' =>
            [
              'name' => 'Futoshiki',
              'shortname' => 'futoshiki',

               'difficulties' => [
                 '6Grid-Hard' => 'HARD (6 Grid)',
               ],

            ],

          //
          'gokigen' =>
            [
              'name' => 'Gokigen',
              'shortname' => 'gokigen',

              'difficulties' => [
                '5x5' => '5x5 Grid',
              ],

            ],

          //
          'kakuro'   =>
            [
              'name' => 'Kakuro',
              'shortname' => 'kakuro',

              'difficulties' => [
                'Grid7' => '7x7 Grid',
                'prod-grid1' => 'Prod Grid 1',
                'prod-grid2' => 'Prod Grid 2',
                'prod-grid3' => 'Prod Grid 3',
                'prod-grid4' => 'Prod Grid 4',
                'prod-grid5' => 'Prod Grid 5',
                'prod-grid6' => 'Prod Grid 6',
                'prod-grid7' => 'Prod Grid 7',
                'prod-grid8' => 'Prod Grid 8',
                'prod-grid9' => 'Prod Grid 9',
                'prod-grid10' => 'Prod Grid 10',
                'prod-grid11' => 'Prod Grid 11',
                'prod-grid12' => 'Prod Grid 12',
                'prod-grid13' => 'Prod Grid 13',
                'prod-grid14' => 'Prod Grid 14',
                'prod-grid15' => 'Prod Grid 15',
                'sum-grid1' => 'Sum Grid 1',
                'sum-grid2' => 'Sum Grid 2',
                'sum-grid3' => 'Sum Grid 3',
                'sum-grid4' => 'Sum Grid 4',
                'sum-grid5' => 'Sum Grid 5',
                'sum-grid6' => 'Sum Grid 6',
                'sum-grid7' => 'Sum Grid 7',
                'sum-grid8' => 'Sum Grid 8',
                'sum-grid9' => 'Sum Grid 9',
                'sum-grid10' => 'Sum Grid 10',
                'sum-grid11' => 'Sum Grid 11',
                'sum-grid12' => 'Sum Grid 12',
                'sum-grid13' => 'Sum Grid 13',
                'sum-grid14' => 'Sum Grid 14',
                'sum-grid15' => 'Sum Grid 15',
                'sum-grid16' => 'Sum Grid 16',
              ],

            ],

          //
          'kendoku' => 
            [
              'name' => 'Kendoku',
              'shortname' => 'kendoku',

              'difficulties' => [
                'Grid5' => '5x5 Grid',
              ],

            ],

          //
          'minesweeper' =>
            [
              'name' => 'Minesweeper',
              'shortname' => 'minesweeper',

              'difficulties' => [
                '8-8-Hard' => '8x8 Hard',
              ],

            ],

          //
          'murapeke' =>
            [
              'name' => 'Murapeke',
              'shortname' => 'murapeke',
              
              'difficulties' => [
                '5x5' => '5 x 5 Grid',
                '6x6' => '6 x 6 Grid',
                '7x7' => '7 x 7 Grid',
                '8x8' => '8 x 8 Grid',
                '9x9' => '9 x 9 Grid',
                '10x20' => '10 x 10 Grid',
              ],

            ],

          //
          'roundabout' =>
            [
              'name' => 'Roundabouts',
              'shortname' => 'roundabout',

              'difficulties' => [
                '6x6' => '6 x 6 Grid',
              ],

            ],

          //
          'sikaku' =>
            [
              'name' => 'Sikaku',
              'shortname' => 'sikaku',

              'difficulties' => [
                'grid5x5' => '5x5 Grid',
                'grid6x6' => '6x6 Grid',
                'grid7x7' => '7x7 Grid',
                'grid8x8' => '8x8 Grid',
                'grid9x9' => '9x9 Grid',
                'grid10x10' => '10x10 Grid',
                'grid11x11' => '11x11 Grid',
                'grid12x12' => '12x12 Grid',
                'grid13x13' => '13x13 Grid',
                'grid14x14' => '14x14 Grid',
                'grid15x15' => '15x15 Grid',
                'grid16x16' => '16x16 Grid',
                'grid17x17' => '17x17 Grid',
              ],

            ],

          //
          'sudoku' =>
            [
              'name' => 'Sudokus',
              'shortname' => 'sudoku',

              'difficulties' => [
                'Level one' => 'Level 1',
                'Level Two' => 'Level 2',
                'Level Three' => 'Level 3',
                'Level Four' => 'Level 4',
                'Level Five' => 'Level 5',
                'Level Six' => 'Level 6',
                'Level Seven' => 'Level 7',
                'Level Eight' => 'Level 8',
                'Level Nine' => 'Level 9',
                'Level Ten' => 'Level 10',
                'Level Eleven' => 'Level 11',
                'Level Twelve' => 'Level 12',
                'Level Thirteen' => 'Level 13',
                'Level Fourteen' => 'Level 14',
                'Level Fifteen' => 'Level 15',
                'Level Sixteen' => 'Level 16',
                'Level Seventeen' => 'Level 17',
              ],

            ],

          //
          'tatami' =>
            [
              'name' => 'Tatami',
              'shortname' => 'tatami',

              'difficulties' => [
                '6x6' => '6 x 6 Grid',
              ],

            ],

          //
          'tent' =>
            [
              'name' => 'Tents',
              'shortname' => 'tent',
              
              'difficulties' => [
                'very easy/5x5' => '5 x 5 Grid - Very Easy',
              ],

            ],

        ],

      ],// End Japanese Puzzle Category
            

    // Mazes Category

    'maze' =>
      [
        'name' =>  'Mazes',
        'shortname' => 'maze',
        'subcategories' => [

          //
          'tubular-maze' =>
            [
              'name' => 'Tubular Mazes',
              'shortname' => 'tubular-maze',

              'difficulties' => [
                'Easy' => 'Easy',
                'Medium' => 'Medium',
                'Medium-Random' => 'Medium Random',
              ],

            ],       

          //
          'square-maze' =>
            [
              'name' => 'Square Mazes',
              'shortname' => 'square-maze',

              'difficulties' => [
                'Easy' => 'Easy',
                'Easy_Random' => 'Easy Random',
                'Random_EMD' => 'Random EMD',
              ],

            ],       

        ],

      ],// End Mazes Category

    ],// End categories
];
