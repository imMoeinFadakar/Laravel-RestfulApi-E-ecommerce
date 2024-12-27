<?php namespace App\Trait;

trait ApiResponse {


public function successResponse($data, $message = null)
{
    return response()->json([

        'stastus' => 'success',

        "code" => 200,

        "data" => $data,

        "message" => $message

    ]);
}



public function errorResponse($code, $data, $message = null)
{
    return response()->json([
        'stastus' => 'error',

        "code" => $code,

        "data" => $data,

        "message" => $message

    ]);
}



}






