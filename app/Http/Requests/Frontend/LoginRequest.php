<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|max:255|',
            'password' => 'required|max:20|min:6',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'max' => ':attribute không được quá :max ký tự!',
            'email' => ':attribute không hợp lệ!',
            // 'failed' => 'These credentials do not match our records.',
            // 'unique' => 'Email tồn tại!',
        ];
    }
}