<?php

namespace App\Http\Requests\auth;

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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|max:255|string|email',
            'password' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "The Email field is required.",
            'password.required' => "The Password field is required.",
            'password.min' => "The Password must be at least 3 characters."
        ];
    }
}
