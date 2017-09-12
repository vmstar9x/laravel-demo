<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'product_name'    => 'required|min:5',
            'product_price'   => 'required|numeric',
            'product_description' => 'required',
            'product_img' => 'required',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function  messages()
    {
        return [
            'product_name.required'  => 'Vui lòng nhập tên sản phẩm',
            'product_name.min'       => 'Tên sản phẩm phải ít nhất có 5 kí tự',
            'product_price.required' => 'Vui lòng nhập giá cho sản phẩm này',
            'product_price.numeric'   => 'Giá của sản phẩm là số !',
            'product_description.required'   => 'Vui lòng nhập giới thiệu sản phẩm',
            'product_img.required'   => 'Vui lòng chọn ảnh tải lên',
        ];
    }

}
