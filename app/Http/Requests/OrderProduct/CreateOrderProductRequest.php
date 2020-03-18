<?php

namespace App\Http\Requests\OrderProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderProductRequest extends FormRequest
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
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|regex:/^[0-9]+$/',
            'total' => 'required|regex:/^\d+(\.\d{2})?$/',
        ];
    }
}
