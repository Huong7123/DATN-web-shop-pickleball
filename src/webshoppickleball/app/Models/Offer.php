<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
        'user_id',
    ];

    public function offerDetails()
    {
        return $this->hasMany(OfferDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
