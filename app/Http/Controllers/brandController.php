<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Resources\apiResource;
use App\Http\Resources\BrandResources;
use App\Models\Brands;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class brandController extends apiController
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $allposts = Brands::all();


        return $this->successResponse(

        apiResource::collection($allposts),

        'all brands');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,
     Brands $brand, 
     BrandRequest $brandRequest
     )
    {
        //


        $validate = validator($request->all(),$brandRequest->rules());

        if($validate->fails())

            return $this->errorResponse(422,

            $validate->getMessageBag(),

            'validation filed!');


        $imageGalleryname = Carbon::now()->microsecond . '.' . $request->image->extension();


        $request->image->storeAs('image/brands',$imageGalleryname,'public');


        $brand->newBrand($request,$imageGalleryname);

        $lastRecoredOfBrand = $brand->query()->orderBy('id','desc')->first();

        return $this->successResponse(

            $lastRecoredOfBrand,
            'inserted!'
            );


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Brands $brands)
    {
        //

        $founded_brand = $brands->findSingleBrand($id);

        return $this->successResponse($founded_brand,'get');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, BrandRequest $brandRequest)
    {
        //
        $Brand = Brands::find($id);

        if($Brand == null){

            return $this->errorResponse(422,$Brand,'not found!');

        }

        $validate = validator($request->all(),$brandRequest->rules());

        if($validate->fails()){

            return $this->errorResponse(422,
            $validate->getMessageBag(),
            'not found!');

        }

        $Brand->updateBrand($request);



        return $this->successResponse($Brand,'data founded');



        //validation



    }


    public function destroy(string $id)
    {
        //

        $brand = Brands::find($id);

        if($brand == null){

            return $this->errorResponse(422,null,'brand is not find!');

        }

        $brand->delete();

        return $this->successResponse($brand->delete(),'brand deleted!');


    }


    public function getProducts(Brands $brands)
    {

        return $this->successResponse(new BrandResources($brands->load('Product'))
            ,'get Products');

    }


}
