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
            'name' => 'required|string',
            'username' => 'required|string|unique:users,id,'.$this->user,
            'email' => 'required|email|unique:users,id,'.$this->user,
            'password' => 'nullable|required_without:_method|confirmed',
            'image' =>'nullable|required_without:_method|image'

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'الاسم بالكامل',
            'username' => 'اسم المستخدم',
            'email' => 'البريد الالكترونى',
            'password' => 'كلمة المرور',
            'image' => 'صورة المستخدم',
        ];
    }

    public function messages(){
        return [
            'image.required_without:_method' => 'الصورة الشخصية مطلوبة',
            'image.required_without' => 'الصورة الشخصية مطلوبة',
        ];
    }
}
