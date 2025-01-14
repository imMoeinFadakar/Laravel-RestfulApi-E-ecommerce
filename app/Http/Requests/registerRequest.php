<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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

            "name" => 'required|alpha',

            "username" => 'required|unique:users,username',

            "age" => 'required|integer',

            "gender" => 'required|integer|boolean',

            "number" => 'required|unique:users,number',

            "address" => 'required',

            "email" => 'required|email',

            "password" => 'required|min:8|max:19',

            "password_conformation" => 'required|same:password'
        ];
    }
}
