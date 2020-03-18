<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
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
            'user_id' => 'required|regex:/^[0-9]+$/',
            'order_product_id' => 'required|regex:/^[0-9]+$/',
            'page_id' => 'required|regex:/^[0-9]+$/',
            'total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required|string|max:3000|nullable',
            'date' => 'required|date',
            'status' => 'required|in:paid,unpaid',
            'payment_method' => 'required|string|max:50',
        ];
    }
}
