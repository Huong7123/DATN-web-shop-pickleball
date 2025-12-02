<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id', // biến thể sản phẩm
        'quantity',           // số lượng mua
        'price',              // giá tại thời điểm mua
    ];
}
