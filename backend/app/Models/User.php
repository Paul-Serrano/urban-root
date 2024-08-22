<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail',
        'pass',
        'firstname',
        'lastname'
    ];

    public function forum()
    {
        return $this->hasMany(Forum::class);
    }

    public function forumPost()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function garden()
    {
        return $this->hasMany(Garden::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
