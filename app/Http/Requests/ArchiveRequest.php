<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArchiveRequest extends FormRequest
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
                    'department_id' => 'required|numeric|exists:departments,id',
                    'archive_code' => 'required|string|min:5|unique:archives,archive_code',
                    'archive_name' => 'required|string',
                    'archive_type' => 'required|string',
                    'archive_position' => 'required|string',
                    'archive_subject' => 'required|string',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'department_id' => 'required|numeric|exists:departments,id',
                    'archive_code' => 'required|string|min:5|unique:archives,archive_code,'. $this->archive_code. ',archive_code',
                    'archive_name' => 'required|string',
                    'archive_type' => 'required|string',
                    'archive_position' => 'required|string',
                    'archive_subject' => 'required|string',
                ];
            }
            default:break;
        }
    }
}
