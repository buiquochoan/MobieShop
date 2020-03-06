<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            //
            'name' => 'required|min:2|max:255',
            'quantity' => 'numeric|required',
            'price' => 'numeric|required',
            'promotional' => 'numeric',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'quantity.required' => 'Số lượng không được để trống',
            'quantity.numeric' => 'Số lượng phải là số',

            'price.required'  => 'Giá không được để trống',
            'price.numeric'  => 'Giá phải là số',

            'promotional.required'  => 'Giảm giá phải là số',
        ];
    }
}
