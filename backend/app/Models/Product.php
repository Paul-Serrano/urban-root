<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_product', 'product_id', 'package_id')->withPivot('quantity');
    }

    public function cola()
    {
        return $this->hasOne(Cola::class);
    }
}
