<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class paymentController extends apiController
{
    //


    public function store(Request $request)
    {
        
        $valiadtion = Validator::make($request->all(),[

           

            "order_details" => "required",

            "order_details.*.product_id" => 'required',

            "order_details.*.quintity" => 'required',
            
            "request_from" => "required"
        ]);


        if($valiadtion->fails()){

            return $this->errorResponse(402,$valiadtion->messages(),'not valied!');

        }

        $total_amount = 0;

        $delivery_amount = 0;

        foreach($request->order_details as $Orders){

            $products = Products::findOrFail($Orders['product_id']);

            if($products->quantity < $Orders['quintity']){

                return $this->errorResponse(422,'Your choosen quintity are more than standared value!');

            }

            $total_amount += $products->price * $Orders['quintity'];
            
            $delivery_amount += $products->delivery_amout;

        }

        $payingAmount = $total_amount + $delivery_amount;

        $amounts = [$payingAmount,$total_amount,$delivery_amount];


        $api = env('API_KEY');
        
        $amount = $payingAmount;

        $mobile = "شماره موبایل";

        $factorNumber = "شماره فاکتور";

        $description = "توضیحات";

        $redirect =  env('CALLBACK_URL');

        $result = $this->send($api, $amount, $redirect, $mobile, $factorNumber, $description);

        $result = json_decode($result);

        if($result->status) {

            orderController::store($request,$amounts);

            orderDetailController::store($request);

            orderDetailController::storeTrasnaction($request,$amounts,$result->token);


            $go = "https://pay.ir/pg/$result->token";
            
            return $this->successResponse([
            
            'URL' => $go,
            
            // "last Price" => $payingAmount,
        
            // "name" => 'moein'

        ],'Ready for payment');

        } else {

            echo $result->errorMessage;
            $this->errorResponse(422,$result->errorMessage);

        }

    }

    public function verify(Request $request)
    {
        
        $api = 'test';

        $token = $request->token;

        $result = response()->json($request);

        $result = json_decode($this->verifyRequest($api,$token));

        if(isset($result->status)){

            if($result->status == 1){
                echo "<h1>تراکنش با موفقیت انجام شد</h1>";

            } else {

                echo "<h1>تراکنش با خطا مواجه شد</h1>";

            }

        } else {

            if($_GET['status'] == 0){

                echo "<h1>تراکنش با خطا مواجه شد</h1>";

            }
        }

    }
            
    function send($api, $amount, $redirect, $mobile = null, $factorNumber = null, $description = null) {
       
        return $this->curl_post('https://pay.ir/pg/send', [
            'api'          => $api,
            'amount'       => $amount,
            'redirect'     => $redirect,
            'mobile'       => $mobile,
            'factorNumber' => $factorNumber,
            'description'  => $description,
        ]);
    }

    function curl_post($url, $params)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
	]);
	$res = curl_exec($ch);
	curl_close($ch);

	return $res;
}

}
