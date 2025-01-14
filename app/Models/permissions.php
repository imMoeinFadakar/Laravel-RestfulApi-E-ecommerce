<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\premissions_roles;

class permissions extends Model
{
    use HasFactory, SoftDeletes;


    // Relations

    public function roles()
    {
       return  $this->belongsToMany(rolls::class);
    }


    public function permissionRoles()
    {
        $this->belongsTo(premissions_roles::class);
    }

}
