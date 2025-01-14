<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class transactionRequiest extends FormRequest
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

            "user_id" => 'required',

            "order_id" => 'required',

            "amount" => 'required|integer',

            "token" => 'required',

            "trans_id" => 'required',

            "status" => 'required|integer',

            "request_from" => 'required|alpha'
        ];
    }
}
