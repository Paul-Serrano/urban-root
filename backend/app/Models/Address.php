<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_number',
        'street_name',
        'postal_code',
        'city',
        'country'
    ];

    public function user() {
       return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function garden() {
        return $this->belongsTo(Garden::class);
    }
}
