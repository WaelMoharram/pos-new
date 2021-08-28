<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => 'required|string|unique:suppliers,id,'.$this->supplier,
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'note' => 'nullable|string',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم المورد',
            'email' => 'البريد الالكترونى',
            'phone' => 'الهاتف',
            'address' => 'العنوان',
            'note' => 'ملاحظات',
        ];
    }
}
