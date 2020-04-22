<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'email' => 'required|email|',
            'phone' => 'required|numeric',
            'address' => 'required|min:2|max:255',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute đúng định dạng email',
            'numeric' => ':attribute không đúng định dạng số',
            'address.min' => 'Địa chỉ nhận hàng phải từ 2 đến 255 ký tự',
            'address.max' => 'Địa chỉ nhận hàng phải từ 2 đến 255 ký tự',
        ];
    }
   public function attributes(){
        return [
            'email' => 'Địa chỉ email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
        ];
   }
}
