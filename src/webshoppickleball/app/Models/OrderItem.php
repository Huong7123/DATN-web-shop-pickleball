<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id', // biến thể sản phẩm
        'quantity',           // số lượng mua
        'price',              // giá tại thời điểm mua
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
