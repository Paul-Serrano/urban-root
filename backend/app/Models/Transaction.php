<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
