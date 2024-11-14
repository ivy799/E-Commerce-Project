<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'name',
        'brand',
        'description',
        'price',
        'stock',
        'image',
        'category',
        'rating',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product_details()
    {
        return $this->hasMany(Product_details::class);
    }
}