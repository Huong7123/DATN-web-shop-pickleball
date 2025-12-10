<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $table = 'payment_transactions';

    protected $fillable = [
        'transaction_id',
        'amount',
        'status',
        'payment_method',
        'vnp_response_code',
        'bank_code',
        'vnp_create_date',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
