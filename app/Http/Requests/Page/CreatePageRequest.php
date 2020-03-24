<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'work_time' => 'required',
            'phone_number' => 'required|min:6',
            'address_id' => 'required|regex:/^[0-9,-]*$/'
        ];
    }
}
