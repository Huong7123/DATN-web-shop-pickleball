<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VNPAY Basic Payment Configuration
    |--------------------------------------------------------------------------
    */

    // Mã MN của bạn do VNPAY cấp
    'vnp_TmnCode' => env('VNP_TMN_CODE'),

    // Secret key để ký hash
    'vnp_HashSecret' => env('VNP_HASH_SECRET'),

    // Link thanh toán của VNPAY (sandbox)
    'vnp_Url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),

    // Link callback sau thanh toán
    'vnp_ReturnUrl' => env('VNP_RETURN_URL'),

    // Các giá trị mặc định
    'vnp_Version' => '2.1.0',
    'vnp_Command' => 'pay',
    'vnp_CurrCode' => 'VND',
    'vnp_Locale' => 'vn',
];
