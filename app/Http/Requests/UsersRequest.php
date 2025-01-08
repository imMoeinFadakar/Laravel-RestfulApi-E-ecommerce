<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //

            'name' => 'required|string',
            'username' => 'required|string|unique:users,name',
            "age"=> 'required|integer',
            "address" => 'required',
            "number" => 'required|unique:users,number' ,
            "gender" => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4|max:15',
            'password_conformation' => 'required|same:password',
            

        ];
    }
}
