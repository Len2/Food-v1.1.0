<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
            'product_id'        => 'required|regex:/^[0-9]+$/',
            'page_id'           => 'required|regex:/^[0-9]+$/',
            'price'             => 'required',
            'description'       => 'nullable|string',
            'status'            => 'nullable|string',
        ];
    }
}