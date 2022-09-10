<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'service_id' =>'required',
            'package_id'=>'required',
            'percentage'=>'required',
            'image'=>'required',
            'price_before_sale'=>'required',
            'price_after_sale'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'service_id.required'=>'لم يتم اختيار الخدمة',
            'package_id.required'=>'لم يتم اختيار الباقة',
            'percentage.required'=>'لم يتم ادخال نسبة الخصم',
            'image.required'=>'لم يتم ادخال صورة العرض',
            'price_before_sale.required'=>'لم يتم ادخال سعر ما قبل الخصم',
            'price_after_sale.required'=>'لم يتم ادخال سعر ما بعد الخصم',
        ];
    }
}
