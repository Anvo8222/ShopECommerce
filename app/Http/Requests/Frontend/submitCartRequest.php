<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class submitCartRequest extends FormRequest
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
            'address' => 'required|max:40|min:6',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'max' => ':attribute không được quá :max ký tự!',
            'min' => ':attribute không nhỏ hơn :min ký tự!',
        ];
    }
}