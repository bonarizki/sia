<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'department_name' => 'required|string|min:2',
            'department_code' => 'required|string|max:4'
        ];
    }

    public function messages()
    {
        return [
            "department_name.required" => "The Department Name field is required.",
            "department_code.required" => "The Department Code field is required.",
            "department_code.max" => "The Department Code max 6 characters.",
        ];
    }
}
