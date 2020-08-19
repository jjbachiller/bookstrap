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
    'GOLD' => 34,
    'SILVER' => 33,
    'STARTER' => 29,
  ]
];
