<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'package_product', 'package_id', 'product_id')->withPivot('quantity');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
