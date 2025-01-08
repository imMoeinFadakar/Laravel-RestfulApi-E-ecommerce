<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class galleries extends Model
{
    use HasFactory,  SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }




}
