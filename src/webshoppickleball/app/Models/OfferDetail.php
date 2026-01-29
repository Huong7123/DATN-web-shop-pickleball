<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferDetail extends Model
{
    use HasFactory;

    protected $table = 'offer_details';
    protected $fillable = [
        'offer_id',
        'discount_id',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}
