<?php

namespace App\Http\Requests\UserLike;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserLikeRequest extends FormRequest
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
            'role_user_id' => 'required',
            'product_id' => 'required|exists:products,id',
        ];
    }
}
