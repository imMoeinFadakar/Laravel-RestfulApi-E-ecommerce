<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            "brand_id" => "required|integer|exists:brands,id",

            "category_id" => "required|integer|exists:categories,id",

            "name" => "required|unique:products,name",

            "description" => "required",

            "primery_image" => "required|image|mimes:jpg,png,jpeg,svg",

            "quantity" => "required|integer",

            "slug" => "required|unique:products,slug",

            "price" => "required|integer",


        ];
    }

    public function messages()
    {
        
        return [

            // Brand id validation messages

            "brand_id.required" => 'برند ایدی محصول باید وارد شود',

            "brand_id.integer" => 'باید به صورت عدد باشد',

            "brand_id.exists" => 'باید در جدول برند ها موجود باشد',

              // Brand id validation messages

              "category_id.required" => 'دسته بندی ایدی محصول باید وارد شود',

              "category_id.integer" => 'باید به صورت عدد باشد',
  
              "category_id.exists" => 'باید در جدول دسته بندی ها  موجود باشد',

            // name valiidation:

            "name.required" => 'نام محصول نباید خالی باشد',

            "name.unique" => '  نام نباید تکراری باشد',

            // describtion validation:
            
            "description" => 'توضیحات  محصول باید وارد شود',

            // image

            "primary_image.required" => 'تصویر هر محصول باید وارد شود',

            "primary_image.image" => 'در اینجا فقط عکس قرار می گیرد',

            "primary_image.mimes" => 'نوع عکس باید از نوع png,jpeg, jpg باشد',

            // Quientity

            "quantity.required" => "تعداد را وارد کنید",
            "quantity.integer" => "تعداد باید به عدد وارد شود",

            // slug

            "slug.required" => ' زیردامنه نباید خالی باشد',

            "slug.unique" => '  زیردامنه نباید تکراری باشد',

            // price

            "price.required" => "قیمت را وارد کنید",
            "price.integer" => "قیمت باید به عدد وارد شود",





        ];

    }


}
