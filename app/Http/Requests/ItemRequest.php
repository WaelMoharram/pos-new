<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|unique:items,id,'.$this->item,
            'image' =>'nullable|image',
            'barcode' => 'required|string|unique:items,id,'.$this->item,
            'code' => 'required|string|unique:items,id,'.$this->item,
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'has_options' => 'required|boolean',


        ];
    }

    public function attributes()
    {
        return [
            'name' => 'الاسم ',
            'image' => 'الصورة ',

        ];
    }
}
