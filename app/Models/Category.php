<?php

namespace App\Models;

// use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function Products()
    {
        
        return $this->hasMany(Products::class);

    }


    public function parent()
    {
        $this->belongsTo(Category::class,'parent_id');
    }

    public function newCategory(Request $request)
    {
        
        $this->query()->create([

            "title" => $request->title,

            "parent_id" => $request->parent_id,

        ]);

    }



    public function ReturnLastRecored()
    {
        
       return $this->query()->orderBy('id','desc')->first();

    }



}
