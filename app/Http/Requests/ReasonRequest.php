<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReasonRequest extends FormRequest
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
            'en.text' =>'required',
            'ar.text'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'en.text.required'=>'لم يتم ادخال السبب بالانجليزية',
            'ar.text.required'=>'لم يتم ادخال السبب بالعربي',
        ];
    }
}
