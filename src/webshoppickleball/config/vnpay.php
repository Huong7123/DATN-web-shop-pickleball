<?php

return [
    'tmn_code'    => env('VNP_TMN_CODE'),
    'hash_secret' => env('VNP_HASH_SECRET'),
    'url'         => env('VNP_URL'),
    'return_url'  => env('VNP_RETURN_URL'),

    'version' => '2.1.0',
    'command' => 'pay',
    'currency' => 'VND',
    'locale' => 'vn',
];

