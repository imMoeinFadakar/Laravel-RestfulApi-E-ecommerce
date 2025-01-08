<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premissions_roles extends Model
{
    use HasFactory;

    public function permission()
    {
        $this->hasMany(permissions::class);
    }

    public function roles()
    {
        $this->hasMany(rolls::class);
    }
}
