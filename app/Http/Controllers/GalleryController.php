<?php

namespace App\Http\Controllers;

use App\Http\Requests\galleryRequest;
use App\Http\Resources\admin\galleryResource;
use App\Models\galleries;
use App\Models\Gallery;
use App\Models\Products;
use Illuminate\Http\Request;

class GalleryController extends apiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Products $product)
    {

    return $this->successResponse(
    galleryResource::collection($product->galleries),
    'returned!');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(galleryRequest $galleryRequest, Products $products)
    {   

        $products->newGallery($galleryRequest);

        if($products->newGallery($galleryRequest) == false){

            return $this->errorResponse(402,'not found');

        }

        return $this->successResponse(true,
        'spurce uploaded successfuly!');


            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products, galleries $galleries)
    {
        //

        $products->deleteGallery($galleries);

        return $this->successResponse(true,'deleted Successfully!');


    }
}
