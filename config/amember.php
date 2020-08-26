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
    ],
    'SILVER' => [
      'id' => 33,
      'name' => 'Silver',
      'icon' => 'flaticon-rocket',
    ],
    'STARTER' => [
      'id' => 29,
      'name' => 'Starter',
      'icon' => 'flaticon-confetti',
    ],
    'FREE' => [
      'id' => 35,
      'name' => 'Free',
      'icon' => 'flaticon-avatar',
    ],
  ]
];
