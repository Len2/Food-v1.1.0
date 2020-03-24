<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'user_id'               => 'required|regex:/^[0-9]+$/',
            'page_id'               => 'required|regex:/^[0-9]+$/',
            'table_id'              => '|regex:/^[0-9]+$/',
            'date'                  => 'required|date',
            'status'                => 'required',
            'type'                  => 'required',
            'current_address_id'   => 'required|regex:/^[0-9]+$/',
            'delivery_address_id'  => 'required|regex:/^[0-9]+$/',
        ];
    }
}
