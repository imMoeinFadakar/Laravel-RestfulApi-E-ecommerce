<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\registerRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       '*'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Relations

    public function roll()
    {
        $this->belongsTo(rolls::class);
    }


    public function orders()
    {
        $this->hasMany(Order::class);
    }

    public function getUserByUsername($username)
    {
        
        return $this->where('username',$username)->first();

    }

    // CRUD operation
    /**
     * Summary of newUser
     * @param \App\Http\Requests\registerRequest $request
     * @return null
     */
    public function newUser(registerRequest $request)
    {

        $this->name= $request->name;

        $this->username = $request->username;

        $this->age = $request->age;

        $this->address = $request->address;

        $this->number = $request->number;

        $this->gender = $request->gender;

        $this->email = $request->email;

        $this->password = bcrypt($request->password);

        $this->roll_id = 0;

        $this->save();

    

    }



    
    public  function updateUser($founded_user)
    {
        
        $this->name = $founded_user->name;

        $this->age = $founded_user->age;

        $this->address = $founded_user->address;

        $this->number = $founded_user->number;

        $this->gender = $founded_user->gender;

        $this->email = $founded_user->email;

        $this->password = bcrypt($founded_user->password);

        $this->roll_id = 0;

        $this->update();

    }

    public function showSingleUser(int $id)
    {
        
        return $this->find('username',$id);

    }

    public  function attemptForLogin(loginRequest $loginRequest)
    {
        $credentials = [

            'username' => $loginRequest['username'],

            'email' => $loginRequest['email'],

            'number' => $loginRequest['number'],

            'password' => $loginRequest['password'],

        ];

        return Auth::attempt($credentials);

    }
    
    public function findUser(loginRequest $loginRequest)
    {
        
        return $this->where('username',$loginRequest->numberOrEmailOrUsername)
        ->orWhere('email',$loginRequest->numberOrEmailOrUsername)
        ->orWhere('number',$loginRequest->numberOrEmailOrUsername)->firstOrFail();

    }

}
