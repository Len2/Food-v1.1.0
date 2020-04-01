<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;


class CreateCategoryRequest extends FormRequest
{
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
            'name' => 'required|min:1|max:255|unique_custom:categories,name,page_id,' . Auth::user()->page->id,
            'image' => 'required|image'
        ];

    }
}
