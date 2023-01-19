<?php

return [

    'marker_hidden_key' => md5("MARKER:HIDDEN:SHOW"),

    'makers_active_list' => 'MARKERS:ACTIVE:LIST:%s',

    'cache' => [

        'skip' => env('SKIP_CACHE', false),

        'refresh_field' => 'refresh',

    ],

];
