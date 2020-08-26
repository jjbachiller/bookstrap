<?php
// Header menu
return [

    'items' => [
        [],
        [
            'title' => 'Home',
            'root' => true,
            'page' => url('/'),
            'new-tab' => false,
        ],
        [
            'title' => 'Pricing',
            'root' => true,
            'page' => url('/#pricing'),
            'new-tab' => false,
        ],
        [
            'title' => 'FAQ',
            'root' => true,
            'page' => url('/#FAQ'),
            'new-tab' => false,
        ],
        [
            'title' => 'Contact',
            'root' => true,
            'page' => '#',
            'custom-class' => 'contactModalTrigger',
            // 'page' => route('contact'),
            'new-tab' => false,
        ],
    ]

];
