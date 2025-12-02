<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',      // tên người nhận
        'user_phone',     // số điện thoại người nhận
        'description',    // mô tả đơn hàng
        'address',        // địa chỉ nhận hàng
        'total',          // tổng tiền
        'status',         // trạng thái đơn hàng
    ];
}
