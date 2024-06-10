<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|min:1|max:255',
            'email' => 'required|string|email|unique:user|max:255',
            'phone' => 'required|unique:user|regex:/^(\+?[0-9]{1,4})?\s?([0-9]{10})$/|max:10',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:100',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'
            ],
            'password_confirmation' => 'required|string|min:8|max:100',

        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Email bắt buộc',
            'email.required' => 'Email bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'phone.required' => 'Số điện thoại bắt buộc',
            'phone.regex' => 'Phải bao gồm 10 ký tự số',
            'phone.max' => 'Tối đa 10 ký tự',
            'password.required' => 'Mật khẩu bắt buộc',
            'password.min' => 'Tối thiểu 8 ký tự ',
            'password.max' => 'Tối thiểu 100 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password.regex' => 'Mật khẩu phải gồm 8 ký tự chữ hoa chữ thường và ký tự đặc biệt',
            'password_confirmation.required' => 'Mật khẩu xác nhận bắt buộc',
        ];
    }
}
