<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
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
            'longitude' => 'required|regex:/^[0-9]+$/',
            'latitude' => 'required|regex:/^[0-9]+$/',
            'city' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/^[0-9]+$/'
        ];
    }
}
