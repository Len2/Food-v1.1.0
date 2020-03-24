<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'longitude' => 'regex:/^[0-9]+$/',
            'latitude' => 'regex:/^[0-9]+$/',
            'city' => '',
            'street' => '',
            'zip_code' => 'regex:/^[0-9]+$/'
        ];
    }
}
