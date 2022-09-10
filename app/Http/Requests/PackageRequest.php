<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'en.name' =>'required',
            'ar.name'=>'required',
            'image'=>'required',
            'price'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'en.name.required'=>'لم يتم ادخال اسم الباقة بالانجليزية',
            'ar.name.required'=>'لم يتم ادخال الباقة بالعربي',
            'image.required'=>'لم يتم ادخال صورة الباقة',
            'price.required'=>'لم يتم ادخال سعر الباقة',
        ];
    }
}
