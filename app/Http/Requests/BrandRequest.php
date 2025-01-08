<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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

            "title" => "required|alpha|unique:brands",

            "image" => "required|image"

        ];
    }

    public function messages()
    {
       return [
        "title.required" => "عنوان باید وارد شود",
        "title.alpha" => "عنوان باید به حروف باشد",
        "title.unique" => "عنوان باید منحصر به فرد باشد",


        "image.required" => "عکس مورد نیاز است",
        "image.image" => "این فایل باید عکس باشد"

       ];
    }

}
