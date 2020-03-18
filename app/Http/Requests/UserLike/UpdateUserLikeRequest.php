<?php

namespace App\Http\Requests\UserLike;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserLikeRequest extends FormRequest
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
            'role_user_id' => 'regex:/^[0-9]+$/',
            'product_id' => 'exists:products,id|regex:/^[0-9]+$/',
        ];
    }
}
