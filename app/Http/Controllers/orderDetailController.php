<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\orders;
use App\Models\Products;
use App\Models\transaction;
use Illuminate\Http\Request;

class orderDetailController extends Controller
{
    //

    public static function getLastOrder()
    {
        
       return orders::query()->latest()->first();

    }


    public static function store($request)
    {
        foreach($request->order_details as $Order){

            $products = Products::query()->findOrFail($Order['product_id']);

            Order_detail::query()->create([

                "order_id" => self::getLastOrder()->id,

                "product_id" => $products->id,

                "price" => $products->price,

                "quintity" => $Order['quintity'],

                "subtotal" => ($products->price * $Order['quintity']),

            ]);


        }
    }


    public static function storeTrasnaction($request,$amounts,$result_token)
    {
        
        transaction::query()->create([

            "user_id" => auth()->user()->id,

            "order_id" => self::getLastOrder()->id,

            "amount" => $amounts[0],

            "token" => $result_token,

            "trans_id" => null,

            "status" => 0,

            "request_from" => $request->request_from

        ]);

    }


}
