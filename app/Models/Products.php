<?php

namespace App\Models;

use Carbon\Carbon;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    /**
     * Relation with categories table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        
        return $this->belongsTo(Category::class);


    }

    /**
     * Relation with brand table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brands()
    {
        
        return $this->belongsTo(Brands::class);


    }


    public function newProduct(Request $request)
    {

        $imagePath = Carbon::now()->microsecond . '.' . $request->primery_image->extension();

        $request->primery_image->storeAs('image',$imagePath,'public');

        $this->query()->create([

            "brand_id" => $request->brand_id,

            "category_id" => $request->category_id,

            "name" => $request->name,

            "description" => $request->description,

            "price" => $request->price,

            "quintity" => $request->quintity,

            "slug" => $request->slug,

            "primery_image" => $imagePath,



        ]);
    
        
        
    }


    public function updateProducts(Request $request)
    {

        if(isset($request->primery_image)){

            $imagePath = Carbon::now()->microsecond . '.' . $request->primery_image->extension();

            $request->primery_image->storeAs('image',$imagePath,'public');

        }


        $this->update([

            "brand_id" => $request->brand_id,

            "category_id" => $request->category_id,

            "name" => $request->name,

            "description" => $request->description,

            "price" => $request->price,

            "quintity" => $request->quintity,

            "slug" => $request->slug,

            "primery_image" => $request->has('image') ? $request->primery_image : $this->primery_image,


        ]);




    }

    public function deleteProduct(Products $product)
    {

        $product->delete();

    }



}
