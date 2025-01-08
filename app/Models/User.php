<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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



    // CRUD operation

    public function newUser(Request $request)
    {
        
        $this->name = $request->name;
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

    
  

}
