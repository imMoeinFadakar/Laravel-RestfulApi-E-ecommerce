<?php

namespace App\Models;

use Illuminate\Http\Client\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request as HttpRequest;

class Brands extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [];

    public function Product()
    {

        return $this->hasMany(Products::class);

    }

  

    // end relations

    public function newBrand($request, $imageName)
    {

       $brand = (new $this);

       $brand->title = $request['title'];

       $brand->image = $imageName;

        $brand->save();
    }

    public function findSingleBrand($id)
    {

        return $this::all()->where('id',$id)->first();

    }

    public function isBrandExist($id)
    {

         if($this->find($id)){

            return true;

         }else{

            return false;

         }


    }

    public function updateBrand($request)
    {
        $this->title = $request['title'];
        $this->image = $request['image'];
        $this->save();

    }






}
