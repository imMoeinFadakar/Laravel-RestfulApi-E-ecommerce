<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rolls extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

  public function users()
  {
    $this->hasMany(User::class);
  }

  public function premissionRolles()
  {
    $this->belongsTo(premissions_roles::class);
  }

  public function permissions()
  {
    
    $this->belongsToMany(permissions::class);

  }

}
