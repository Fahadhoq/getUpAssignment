<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    // Table name if it's not the plural form of the model name
    protected $table = 'roles';

    // A Role can have many Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

}

