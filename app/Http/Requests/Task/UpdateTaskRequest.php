<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'task_list_id' => 'regex:/^[0-9]+$/',
            'status' => 'string',
            'description' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'notify_email' => 'string',
            'attachment' => 'string'
        ];
    }
}
