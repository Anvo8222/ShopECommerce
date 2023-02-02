<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
      'password' => 'max:20|min:6|nullable',
      'address' => 'max:40|min:2|nullable',
      'phone' => 'nullable',
      'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
    ];
  }
  public function messages()
  {
    return [
      'required' => ':attribute không được để trống!',
      'max' => ':attribute không được quá :max ký tự!',
      'min' => ':attribute không nhỏ hơn :min ký tự!',
      'email' => ':attribute không hợp lệ!',
      'mimes' => ':attribute phải là (jpeg,png,jpg,gif)',
    ];
  }
}