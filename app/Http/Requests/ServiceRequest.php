<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'en.desc' =>'required',
            'ar.desc'=>'required',
            'icon'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'en.name.required'=>'لم يتم ادخال اسم الخدمة بالانجليزية',
            'ar.name.required'=>'لم يتم ادخال الخدمة بالعربي',
            'en.desc.required'=>'لم يتم ادخال وصف الخدمة بالانجليزية',
            'ar.desc.required'=>'لم يتم ادخال وصف الخدمة بالعربي',
            'icon.required'=>'لم يتم ادخال ايقونة الخدمة',
        ];
    }
}
