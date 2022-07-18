<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            case 'POST':
            {
                return [
                    'employee_id' => 'required|numeric|unique:users,employee_id',
                    'name' => 'required|string|min:2',
                    'email' => 'required|string|email|unique:users,email',
                    'phone_number' => 'required|string|unique:users,phone_number',
                    'department_id' => 'required|string',
                    'role' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'employee_id' => 'required|numeric|unique:users,employee_id,'. $this->employee_id . ',employee_id',
                    'name' => 'required|string|min:2',
                    'email' => 'required|string|email|unique:users,email,' . $this->email . ',email',
                    'phone_number' => 'required|string|unique:users,phone_number,' . $this->phone_number .',phone_number',
                    'department_id' => 'required|string',
                    'role' => 'required',
                ];
            }
            default:break;
        }
    }

    public function message()
    {
       
    }
}
