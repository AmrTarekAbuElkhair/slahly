<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'country_id'=>'required',
            'city'=>'required',
            'address'=>'required',
            'verified_status'=>'required',
            'status'=>'required',
            'image'=>'required',
            'password'=>'required',
            'lat'=>'required',
            'lng'=>'required',
        ];
    }
    public function messages(){
        return[
            'name.required'=>'لم يتم ادخال الاسم',
            'email.required'=>'لم يتم ادخال البريد الالكتروني',
            'mobile.required'=>'لم يتم ادخال رقم التليفون',
            'country_id.required'=>'لم يتم ادخال البلد',
            'city.required'=>'لم يتم ادخال المدينة',
            'address.required'=>'لم يتم ادخال العنوان',
            'verified_status.required'=>'لم يتم ادخال حالة التفعيل',
            'status.required'=>'لم يتم ادخال حالة',
            'image.required'=>'لم يتم ادخال الصور',
            'password.required'=>'لم يتم ادخال كلمة السر',
            'lat'=>'لم يتم ادخال الاحداثيات',
            'lng'=>'لم يتم ادخال الاحداثيات',
        ];

    }
}
