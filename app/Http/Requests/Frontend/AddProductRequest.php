<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
      // 'name' => 'required|max:200',
      // 'price' => 'required|integer',
      // 'category' => 'required',
      // 'brand' => 'required',
      // 'brand' => 'required',
      // 'value_sale' => 'integer',
      // 'company' => 'required|max:50',
      // 'details' => 'required|max:500',
      // 'image' => 'required|max:3',
      'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|'
    ];
  }
  public function messages()
  {
    return [
      'required' => ':attribute không được để trống!',
      'max' => ':attribute không được quá :max!',
      'email' => ':attribute không hợp lệ!',
      'integer' => ':attribute không hợp lệ!',
      'mimes' => ':attribute phải là (jpeg,png,jpg,gif)',
      // 'failed' => 'These credentials do not match our records.',
      // 'unique' => 'Email tồn tại!',
    ];
  }
}