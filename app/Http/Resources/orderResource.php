<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class orderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "status" => $request->status == 1 ? "success" : "failure",

            "total_amount" => $request->total_amount ."تومان"  ,

            "delivery_amount" => $request->delivery_amount ."تومان" ,

            "paying_amount" => $request->paying_amount ."تومان"  ,

            "paying_status" => $request->paying_status == 1 ? "success" : "failure!",
        ];
    }
}
