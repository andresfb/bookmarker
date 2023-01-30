<?php

return [

    'marker_hidden_key' => md5('MARKER:HIDDEN:SHOW'),

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

            'service_minutes' => env('SERVICES_CACHE_TTL_MINUTES', 15),

            'view_models_minutes' => env('VIEW_MODELS_CACHE_TTL_MINUTES', 10),

            'short_lived_minutes' => env('SHORT_LIVED_CACHE_TTL_MINUTES', 5),

        ],

    ],

    'admin_user' => env('ADMIN_USER_EMAIL')
];
