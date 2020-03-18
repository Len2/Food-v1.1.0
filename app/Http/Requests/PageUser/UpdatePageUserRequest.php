<?php

namespace App\Http\Requests\PageUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageUserRequest extends FormRequest
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
            'user_role_id' => 'regex:/^[0-9,-]*$/',
            'page_role_id' => 'regex:/^[0-9,-]*$/',
            'page_id' => 'regex:/^[0-9,-]*$/',
        ];
    }
}
