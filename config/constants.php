<?php

return [

    'marker_hidden_key' => 'MARKER:HIDDEN:SHOW:%s',

    'pagination' => [

        'default' => [

            'per_page_options' => [20, 40, 80],

            'per_page_default' => 20,

        ],

    ],

    'cache' => [

        'skip' => env('SKIP_CACHE', false),

        'refresh_field' => 'refresh',

        'refresh_key' => 'CACHE:REFRESH:KEY:%s',

        'ttl' => [

            'long_lived_minutes' => env('LONG_LIVED_CACHE_TTL_MINUTES', 30),

            'medium_lived_minutes' => env('MEDIUM_LIVED_CACHE_TTL_MINUTES', 15),

            'short_lived_minutes' => env('SHORT_LIVED_CACHE_TTL_MINUTES', 5),

        ],

    ],

    'admin_user' => env('ADMIN_USER_EMAIL')
];
