<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\categiryRequest;
use App\Models\Category;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\apiController;
use App\Http\Resources\categoryResource;
use App\Models\Brands;

class categoryController extends apiController
{

    use ApiResponse;


    public function getProducts(Category $Category)
    {
        
        return $this->successResponse(
        new categoryResource(
         $Category->load('Products')));

    }


    public function validatecategoryRequest()
    {
        
        

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        //

        $allCategoriess = $category::all();

        return $this->successResponse(
        categoryResource::collection($allCategoriess),
        'all categories!');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Category $category, categiryRequest $categoryRequest)
    {
        //

        $validate = validator($request->all(),$categoryRequest->rules());

        if($validate->fails()){

            return $this->errorResponse(422,
            $validate->getMessageBag(),
             'validate filed!');

        }

        $category->newCategory($request);
        
        $newCategoryRecord = $category->ReturnLastRecored();


        return $this->successResponse(new categoryResource($newCategoryRecord),'category added!');
        

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
    public function destroy(string $id)
    {
        //
    }


  

}
