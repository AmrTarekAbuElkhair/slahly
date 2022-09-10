<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|unique:users,email,' . $this->id . ',id',
            'mobile'=>'unique:users,mobile,' . $this->id . ',id',
            'service_id'=>'required',
            'type_id'=>'required',
            'country_id'=>'required',
            'city'=>'required',
            'address'=>'required',
            'verified_status'=>'required',
            'status'=>'required',
            'image'=>'required',
            'bio'=>'required',
            'gender'=>'required',
            'password'=>'required',
            'price'=>'required',
            'code'=>'required',
        ];
    }
    public function messages(){
        return[
            'name.required'=>'لم يتم ادخال الاسم',
            'email.required'=>'لم يتم ادخال البريد الالكتروني',
            'mobile.required'=>'لم يتم ادخال رقم التليفون',
            'service_id.required'=>'لم يتم ادخال الخدمة',
            'type_id.required'=>'لم يتم ادخال نوع الحساب',
            'country_id.required'=>'لم يتم ادخال البلد',
            'city.required'=>'لم يتم ادخال المدينة',
            'address.required'=>'لم يتم ادخال العنوان',
            'verified_status.required'=>'لم يتم ادخال حالة التفعيل',
            'status.required'=>'لم يتم ادخال حالة',
            'image.required'=>'لم يتم ادخال الصور',
            'password.required'=>'لم يتم ادخال كلمة السر',
            'price.required'=>'لم يتم ادخال السعر',
            'bio.required'=>'لم يتم ادخال الوصف',
            'gender.required'=>'لم يتم ادخال الجنس',
            'code'=>'لم يتم ادخال رمز الاستجابة السريعة',
        ];

    }
}
