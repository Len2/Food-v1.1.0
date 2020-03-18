<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'user_id'               => 'regex:/^[0-9]+$/',
            'page_id'               => 'regex:/^[0-9]+$/',
            'table_id'              => 'regex:/^[0-9]+$/',
            'date'                  => 'date',
            'status'                => 'string',
            'type'                  => 'string',
            'current_location_id'   => 'regex:/^[0-9]+$/',
            'delivery_location_id'  => 'regex:/^[0-9]+$/',
        ];
    }
}
