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
            'username' => 'required|username|unique:users,id,'.$this->user,
            'password' => 'nullable|required_without:_method|confirmed',
            //'image' =>'nullable|image'

        ];
    }

    public function attributes()
    {
        return [
            'full_name' => __('Full name'),
            'email' => __('Email'),
            'password' => __('Password'),
        ];
    }
}
