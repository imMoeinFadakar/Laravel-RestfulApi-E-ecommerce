<?php

namespace App\Http\Controllers;

use App\Http\Resources\productResource;
use App\Models\product;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends apiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $product = Products::paginate(10);

        Return $this->successResponse([

            "products" => productResource::collection($product),
            
            "links" => productResource::collection($product)->response()->getData()->links,



        ],'all products');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Products $product)
    {
        //

        $validate = validator($request->all(),[

            "brand_id" => "required|integer|exists:brands,id",

            "category_id" => "required|integer|exists:categories,id",

            "name" => "required|unique:products,name",

            "description" => "required",

            "primery_image" => "required|image|mimes:jpg,png,jpeg,svg",

            "quintity" => "required|integer",

            "slug" => "required|unique:products,slug",

            "price" => "required",
            

        ]);

        if($validate->fails())

            return $this->errorResponse(422,
        
            $validate->getMessageBag(),
        
            'validation filed!');

        $product->newProduct($request);

        $responseData = $product->orderBy('id','desc')->first();

        return $this->successResponse(new productResource($responseData),
        'products added!');
       


    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        //

      return $this->successResponse(new productResource($product),'GET'. ' ' .$product->name );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        //
        $validate = validator($request->all(),[

            "brand_id" => "required|integer|exists:brands,id",

            "category_id" => "required|integer|exists:categories,id",

            "name" => "required|unique:products,name",

            "description" => "required",

            "primery_image" => "image|mimes:jpg,png,jpeg,svg|nullable",

            "quintity" => "required|integer",

            "slug" => "required",

            "price" => "required",
            

        ]);

        if($validate->fails())

            return $this->errorResponse(422,
        
            $validate->getMessageBag(),
        
            'validation filed!');


        $slagUnique = Products::where('slug',$request->slug)

        ->where('slug' , $product->id)->exists();

        if($slagUnique){

            return $this->errorResponse(422,'This slug is already being taken!');
        }





        $product->updateProducts($request);

        return  $this->successResponse(

        new productResource($product),

        $product->name . ' ' .'product updated successfuly!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        //

        $product->deleteProduct($product);


        return $this->successResponse('success!' ,$product->name. ' ' .'Deleted Successfuly!');


    }
}
