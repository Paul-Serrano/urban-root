<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = "forums";

    protected $fillable = [
        'user_id',
        'title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(ForumPost::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'forum_category');
    }
}
