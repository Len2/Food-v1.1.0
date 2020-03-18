<?php

namespace App\Http\Requests\TaskList;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskListRequest extends FormRequest
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
            'name'=>'required|string',
            'page_id'=>'required|regex:/^[0-9]+$/'
        ];
    }
}
