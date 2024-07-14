<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function exporter()
    {
        return $this->belongsTo(Exporter::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function ultimateConsignee()
    {
        return $this->belongsTo(UltimateConsignee::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
