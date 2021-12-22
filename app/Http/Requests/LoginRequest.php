<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
            'remember'  => 'sometimes|nullable|in:1'
        ];
    }

    public function attributes(): array
    {
        return [
            'email'     => 'Email',
            'password'  => 'Password',
            'remember'  => 'Remember me',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email is required',
            'email.email'       => 'Email must be valid email',

            'password.required' => 'Password is required',
            'password.min'      => 'Password must be at least 6 numbers or characters',

            'password.in'      => 'Remember me value is invalid',
        ];
    }

}
