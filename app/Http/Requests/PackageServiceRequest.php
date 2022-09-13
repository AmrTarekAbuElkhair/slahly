<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageServiceRequest extends FormRequest
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
            'package_id'=>'required',
            'service_id'=>'required',
            'en.text' =>'required',
            'ar.text'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'package_id.required'=>'لم يتم اختيار اي باقة',
            'service_id.required'=>'لم يتم اختيار اي خدمة',
            'en.text.required'=>'لم يتم ادخال وصف خدمة الباقة بالانجليزية',
            'ar.text.required'=>'لم يتم ادخال وصف خدمة الباقة بالعربي',
        ];
    }
}
