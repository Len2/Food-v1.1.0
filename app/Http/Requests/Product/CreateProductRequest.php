<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('category-create');
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You have not permission');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|string',
            'active' =>'required',
            'initial_price' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ];
    }
}
