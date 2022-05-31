<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|unique:stores,name,'.$this->store,
            'address' => 'required|string|unique:stores,address,'.$this->store,

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم المخزن',
            'address' => 'العنوان',
        ];
    }
}
