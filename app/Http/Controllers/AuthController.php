<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\registerRequest;
use Illuminate\Routing\RedirectController;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AuthController extends apiController
{
    //


    public function Register(registerRequest $registerRequest, User $user)
    {

       $user->newUser($registerRequest);

        $last_user = $user->query()->orderBy('id','desc')->firstOrFail();

        
        $token = $this->CraeteTokenSanctum($registerRequest->name,$last_user);



        return $this->successResponse([

            "user" => $last_user,

            "token" => $token

        ],'wellcome to our website! registered!');



    }

    
    public function Login(loginRequest $loginRequest, User $user)
    {
        
       $user->attemptForLogin($loginRequest);

       $findUser = $user->findUser($loginRequest);

        if($findUser != null){

            $token = $this->CraeteTokenSanctum('login',$findUser);
        

            return $this->successResponse([
    
                "user" => $findUser,
    
                "token" => $token
    
            ]);

        }

        return $this->errorResponse(404,'information is not correct!','failure');


    }


    public function Logout()
    {
        Auth::user()->tokens()->delete();

        return $this->successResponse('loggied Out!');

    }

    public function CraeteTokenSanctum($token_name, $user)
    {
        
      return  $user->createToken($token_name,['*'],

      Carbon::now()->addMinutes(20)

      )->plainTextToken;

    }

}
