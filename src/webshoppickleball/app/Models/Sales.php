<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sales extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'sales';

    protected $fillable = [
        'npp',
        'parent',
        'personal_sales',
        'total_sales',
        'month',
    ];
}
