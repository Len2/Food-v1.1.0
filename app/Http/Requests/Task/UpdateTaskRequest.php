<?php

namespace App\Http\Requests\Task;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return Gate::allows('task-edit');
        return true;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You have no permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_list_id' => 'exists:task_lists,id|regex:/^[0-9]+$/',
            'status' => 'string',
            'description' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'notify_email' => 'string',
            'attachment' => 'string'
        ];
    }
}
