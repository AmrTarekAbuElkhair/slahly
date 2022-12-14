<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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
            'url' =>'required',
            'logo'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'url.required'=>'لم يتم ادخال لينك موقع التواصل الاجتماعي',
            'logo.required'=>'لم يتم ادخال لوجو موقع التواصل الاجتماعي',
        ];
    }
}
