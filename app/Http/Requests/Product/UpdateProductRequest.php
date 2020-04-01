<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product-edit');
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
            //'category_id' => 'required|regex:/^[0-9,-]*$/',
           // 'image' => 'required|image',
        ];
    }
}
