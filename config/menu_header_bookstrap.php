<?php
// Header menu
return [

    'items' => [
        [],
        [
            'title' => 'Home',
            'root' => true,
            'page' => app()->runningInConsole() ? '' : url('/'),
            'new-tab' => false,
        ],
        [
            'title' => 'Pricing',
            'root' => true,
            'page' => app()->runningInConsole() ? '' : url('/#pricing'),
            'new-tab' => false,
        ],
        [
            'title' => 'FAQ',
            'root' => true,
            'page' => app()->runningInConsole() ? '' : url('/#FAQ'),
            'new-tab' => false,
        ],
        [
            'title' => 'Contact',
            'root' => true,
            'page' => '#',
            'custom-class' => 'contactModalTrigger',
            'new-tab' => false,
        ],
    ]

];
