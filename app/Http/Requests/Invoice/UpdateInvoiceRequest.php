<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id|regex:/^[0-9]+$/',
            'order_product_id' => 'required|exists:orders_products,id|regex:/^[0-9]+$/',
            'page_id' => 'required|exists:pages,id|regex:/^[0-9]+$/',
            'total' => 'regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'string|max:3000|nullable',
            'date' => 'date',
            'status' => 'in:paid,unpaid',
            'payment_method' => 'string|max:50',
        ];
    }
}
