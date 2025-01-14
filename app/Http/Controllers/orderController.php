<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    //

    public static function store($request,array $amounts)
    {

       return  $Order = orders::query()->create([

            "user_id" => auth()->user()->id,

            "status" => 1,

            "total_amount" => $amounts[1],

            "delivery_amount" => $amounts[2],

            "paying_amount" => $amounts[0],

            "paying_status" => 0



        ]);

    


    }


    

}
