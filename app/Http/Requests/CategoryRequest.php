<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,id,'.$this->category,
            'image' =>'nullable|image',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم التصنيف',
            'image' => 'صورة التصنيف',

        ];
    }
}
