<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'latitude',
        'longitude',
        'img_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
