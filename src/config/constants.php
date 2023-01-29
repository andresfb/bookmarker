<?php

return [

    'marker_hidden_key' => md5('MARKER:HIDDEN:SHOW'),

    'pagination' => [

        'default' => [

            'per_page_options' => [10, 50, 100],

            'per_page_default' => 50,

        ],

    ],

    'cache' => [

        'skip' => env('SKIP_CACHE', false),

        'refresh_field' => 'refresh',

        'ttl' => [

            'service_minutes' => env('SERVICES_CACHE_TTL_MINUTES', 15),

            'view_models_minutes' => env('VIEW_MODELS_CACHE_TTL_MINUTES', 10),

            'short_lived_minutes' => env('SHORT_LIVED_CACHE_TTL_MINUTES', 5),

        ],

    ],
];
