<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderDetailRequest extends FormRequest
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
            
            "order_id" => "required|integer",

            "product_id" => "required|integer",

            "price" => "required|integer",

            "quintity" => "required|integer",
            
            "subtotal" => "required|alpha|max:40",

        ];
    }
}
