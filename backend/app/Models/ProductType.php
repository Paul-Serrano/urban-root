<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function colas()
    {
        return $this->hasMany(Cola::class);
    }
}
