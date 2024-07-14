<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UltimateConsignee extends Model
{
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
