<?php

namespace App\Http\Requests\GalleryImage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class CreateGalleryImageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gallery-create');
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You have not permission');
    }
    public function rules()
    {
        return [
           // 'photo' => 'required|image',
        ];
    }
}
