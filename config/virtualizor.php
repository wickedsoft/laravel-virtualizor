<?php

return [

    'default' => env('VIRTUALIZOR_CONNECTION', 'default'),

    'sites' => [
        'default' => [
            'url' => env('VIRTUALIZOR_DEFAULT_URL'),
            'key' => env('VIRTUALIZOR_DEFAULT_KEY'),
        ],
    ],

    'client_options' => [
        \GuzzleHttp\RequestOptions::COOKIES => true,
        \GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => 10,
        \GuzzleHttp\RequestOptions::TIMEOUT => 10,
        \GuzzleHttp\RequestOptions::ALLOW_REDIRECTS => false,
        \GuzzleHttp\RequestOptions::HEADERS => [
                'Authorization' => "Token ".env('VIRTUALIZOR_DEFAULT_KEY'),
        ],
    ],

];
