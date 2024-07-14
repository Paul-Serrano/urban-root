<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
