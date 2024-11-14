<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_details extends Model
{
    protected $fillable = [
        'size',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
