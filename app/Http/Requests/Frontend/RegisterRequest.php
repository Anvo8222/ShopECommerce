<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:40',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|max:20|min:6',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'max' => ':attribute không được quá :max ký tự!',
            'min' => ':attribute không nhỏ hơn :min ký tự!',
            'email' => ':attribute không hợp lệ!',
            'unique' => 'Email tồn tại!',
        ];
    }
}