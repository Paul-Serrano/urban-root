<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Event;
use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\Garden;
use App\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable; // Importez la classe Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable // Étendez Authenticatable plutôt que Model
{
    use HasFactory;

    protected $fillable = [
        'mail',
        'pass',
        'firstname',
        'lastname',
        'role_id',
        'address_id',
    ];

    protected $hidden = [
        'pass',
    ];

    // Optionnel : Si vous avez des castings spécifiques, ajoutez-les ici
    protected $casts = [
        // Par exemple, pour les dates
        'email_verified_at' => 'datetime',
    ];

    // Optionnel : Ajoutez d'autres méthodes ou propriétés spécifiques si nécessaire

    public function address()
    {
        return $this->hasOne(Address::class);
    }

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
