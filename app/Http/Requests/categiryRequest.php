<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class categiryRequest extends FormRequest
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
            "title" => "required|string|unique:categories,title",

            "parent_id" => "nullable|integer"
        ];
    }

    public function messages()
    {
        
        return [

            "title.required" => 'عنوان دسته بندی نباید خالی باشد',

            "title.string" => 'عنوان دسته بندی باید تنها شامل حروف باشد',

            "title.unique" => 'عنوان دسته بندی نباید تکراری باشد',

            "parent_id.integer" => 'کلید دسته بندی باید به شکل عدد باشد',


        ];

    }



    public function failedValidation(validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'status' => false,
            "code" => 442,
            "data" => $validator->errors(),
            "message" => "احراز هویت موفقیت امیز نبود"



        ]));
    }


 


}
