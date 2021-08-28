<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|string|unique:clients,id,'.$this->client,
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم العميل',
            'email' => 'البريد الالكترونى',
            'phone' => 'الهاتف',
            'address' => 'العنوان',
            'notes' => 'ملاحظات',
        ];
    }
}
