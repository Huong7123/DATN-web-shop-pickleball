<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'image',
        'name',
        'slug',
        'description',
        'category_id',
        'price',
        'quantity',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'product_id', 'attribute_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class,'attribute_value_product','product_id','attribute_value_id');
    }
}
