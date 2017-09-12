<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'username' => 'required|min:5',
            'pass'     => 'required|min:5|max:32',
            'email'    => 'required|email',
            'user_img' => 'required|image:jpg,jpeg,png|max:2048',
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
            'username.required' => 'Vui lòng nhập UserName',
            'username.min'      => 'UserName phải ít nhất có 5 ki tu',
            'pass.required'     => 'Vui lòng nhập PassWord',
            'pass.min'          => 'Password vui lòng nhập từ 5 - 32 kí tự',
            'pass.max'          => 'Password vui lòng nhập từ 5 - 32 kí tự',
            'email.required'    => 'Vui lòng nhập Email',
            'email.email'       => 'Vui lòng nhập đúng định dạng Email',
            'user_img.required' => 'Vui lòng chọn ảnh đại diện',
            'user_img.image'    => 'Vui lòng nhập đúng định dạng hình ảnh JPG, JPEG,PNG',
            'user_img.max'      => 'Ảnh nhập vui lòng không quá 2MB',
        ];
    }

}
