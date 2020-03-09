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
            'name' => 'required|min:2|max:255',
            'quantity' => 'numeric|required',
            'price' => 'numeric|required',
            'promotional' => 'numeric|required',
            'myFile' => 'mimes:jpg,jpeg,png,bmp,tiff|max:5120|required',
        ];

    }
    public function messages()
    {
        return [
            'min' => ':attribute phải từ 2 đến 255 ký tự',
            'max' => ':attribute phải từ 2 đến 255 ký tự hoặc file nhỏ hơn 5MB',
            'required' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            'mimes' => ':attribute phải là ảnh',
        ];
    } 
    public function attributes(){
        return [
             'name' => 'Tên sản phẩm',   
             'quantity'=>'Số lượng',
             'price'=>'Đơn giá',
             'promotional'=>'Khuyến mại',
             'myFile' => 'File upload',
        ];
    }
}
