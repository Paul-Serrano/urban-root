<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cola extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
}
