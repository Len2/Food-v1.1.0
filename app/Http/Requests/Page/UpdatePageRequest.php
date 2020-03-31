<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class UpdatePageRequest extends FormRequest
{

    public function authorize()
    {
        return Gate::allows('page-create');
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You have not permission');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'description' => 'required',
            'work_start' => 'required',
            'work_end' => 'required',
        ];
    }
}
