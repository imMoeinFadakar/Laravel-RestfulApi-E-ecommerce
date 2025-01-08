<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class galleryResource extends JsonResource
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

            "products_id" =>$this->products_id,

            "path" => url(env('IMAGE_UPLOADED_FOR_GALLERIES').$this->path),
                        
            "mime" => $this->mime


        ];    }
}
