<?php

namespace App\Http\Requests\PageFollower;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageFollowerRequest extends FormRequest
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
            'page_id' => 'required|exists:pages,id|regex:/^[0-9]+$/',
            'user_id' => 'required|exists:users,id|regex:/^[0-9]+$/',
        ];
    }
}
