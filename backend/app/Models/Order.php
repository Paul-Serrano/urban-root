<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function ultimateConsignee()
    {
        return $this->belongsTo(UltimateConsignee::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function priorNotice()
    {
        return $this->hasOne(PriorNotice::class);
    }
}
