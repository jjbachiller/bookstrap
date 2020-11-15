<?php
// aMember Settings
return [
  'base_url' => env('AMEMBER_BASE_URL', ''),
  '_key' => env('AMEMBER_API_KEY', ''),
  'actions' => [
    'login' => '/check-access/by-login-pass',
  ],
  //SUBSCRIPTION ORDER FROM MORE EXPENSIVE TO LESS
  'subscriptions' => [
    'GOLD' => [
      'id' => 34,
      'name' => 'Gold',
      'icon' => 'flaticon-trophy',
      'disk_quote' => 5368709120,
      'week_downloads' => 250,
      'max_books' => 300,
      'max_pages_book' => 220,
      'library_content' => [ 'full' ],
    ],
    'SILVER' => [
      'id' => 33,
      'name' => 'Silver',
      'icon' => 'flaticon-rocket',
      'disk_quote' => 1073741824,
      'week_downloads' => 100,
      'max_books' => 120,
      'max_pages_book' => 120,
      'library_content' => [ 'full' ],
    ],
    'STARTER' => [
      'id' => 32,
      'name' => 'Starter',
      'icon' => 'flaticon-confetti',
      'disk_quote' => 262144000,
      'week_downloads' => 25,
      'max_books' => 50,
      'max_pages_book' => 32,
      'library_content' => [
          'sudoku'
      ],
    ],
    'FREE' => [
      'id' => 35,
      'name' => 'Free',
      'icon' => 'flaticon-avatar',
      'disk_quote' => 0,
      'week_downloads' => 0,
      'max_books' => 0,
      'max_pages_book' => 0,
      'library_content' => [ ],
    ],
  ]
];
