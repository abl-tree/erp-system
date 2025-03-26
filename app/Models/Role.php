<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function subRole()
    {
        return $this->hasMany(SubRole::class);
    }
}
