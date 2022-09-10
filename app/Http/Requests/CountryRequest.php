<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'digits'=>'required',
            'logo'=>'required',
            'code'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'en.name.required'=>'لم يتم ادخال اسم الدولة بالانجليزية',
            'ar.name.required'=>'لم يتم ادخال اسم الدولة بالعربي',
            'digits.required'=>'لم يتم ادخال عدد ارقام',
            'logo.required'=>'لم يتم ادخال لوجو الدولة',
            'code.required'=>'لم يتم ادخال كود الدولة',
        ];
    }
}
