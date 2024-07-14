<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function note()
    {
        return $this->hasOne(Note::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function ultimateConsignee()
    {
        return $this->belongsTo(UltimateConsignee::class);
    }

    public function exporter()
    {
        return $this->belongsTo(Exporter::class);
    }
}
