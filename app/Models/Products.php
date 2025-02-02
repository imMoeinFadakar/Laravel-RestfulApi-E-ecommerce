<?php

namespace App\Models;

use Carbon\Carbon;
use App\Trait\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    // start relationships functions

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
    public function brand()
    {

        return $this->belongsTo(Brands::class);


    }


    public function galleries()
    {
        return $this->hasMany(galleries::class);
    }


    public function category()
    {
        
        return $this->belongsTo(Products::class);

    }



    // end relationship

    public function newProduct(Request $request)
    {

        $imagePath = Carbon::now()->microsecond . '.' . $request->primery_image->extension();

        $request->primery_image->storeAs('images/products',$imagePath,'public');

        $this->query()->create([

            "brand_id" => $request->brand_id,

            "category_id" => $request->category_id,

            "name" => $request->name,

            "description" => $request->description,

            "price" => $request->price,

            "quantity" => $request->quantity,

            "slug" => $request->slug,

            "primary_image" => $imagePath,



        ]);



    }

    public function newGallery(Request $request)
    {   

        if($request->hasFile('path')){

            foreach($request->path as $image){

                $imageGalleryname = Carbon::now()->microsecond * 2 . '.' . $image->extension();

                $image->storeAs('images/Galleries',$imageGalleryname,'public');

                $this->galleries()->create([

                    "products_id" => $this->id,

                    "path" => $imageGalleryname,

                    "mime" => $image->getClientMimeType()

                ]);

            }

        }else{

            return false;

        }


      


       
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


    public function deleteGallery(galleries $galleries)
    {

        // Storage::delete($galleries->path);

        unlink(public_path('storage/images/Galleries/'.$galleries->path));

       $galleries->delete();

    }

    public function deleteProduct(Products $product)
    {

        $product->delete();

    }



}
