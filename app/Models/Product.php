<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category',
    ];


    public function comment_rating()
    {
        return $this->hasMany(Comment_Rating::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class);
    }

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }
}