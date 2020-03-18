<?php

namespace App\Http\Requests\GalleryImage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryImageRequest extends FormRequest
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
            'page_id' => 'regex:/^[0-9]+$/',
            'user_id' => 'regex:/^[0-9]+$/',
            'album_id' => 'regex:/^[0-9]+$/',
            'photo' => 'image',
        ];
    }
}
