<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'en.title' =>'required',
            'ar.title'=>'required',
            'en.desc' =>'required',
            'ar.desc'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'en.title.required'=>'لم يتم ادخال العنوان بالانجليزية',
            'ar.title.required'=>'لم يتم ادخال العنوان بالعربي',
            'en.desc.required'=>'لم يتم ادخال النص بالانجليزية',
            'ar.desc.required'=>'لم يتم ادخال النص بالعربي',
        ];
    }
}
