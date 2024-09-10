<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'title',
        'description',
        'date',
        'latitude',
        'longitude',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
