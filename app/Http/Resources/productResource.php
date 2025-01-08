<?php

namespace App\Http\Resources;

use App\Http\Resources\admin\galleryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "id" => $this->id,

            "brand_id" => $this->brand_id,

            "category_id" => $this->category_id,

            "name"=> $this->name,

            "primery_image"=> url(env('IMAGE_UPLOADED_FOR_PRODUCTS').$this->primery_image),

            "price" =>  $this->price,

            "description" =>  $this->description,

            "quintity" =>  $this->quintity,

            "Galleries" => galleryResource::collection($this->galleries)

       
        ]; 
    }
}
