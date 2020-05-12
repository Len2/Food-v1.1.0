<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class CreateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('invoice-create');
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You have not permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => 'required|unique:invoices',
            'file' => 'required|file',
            'status' => 'in:paid,unpaid',
            'description' => 'string|max:3000|nullable',
        ];
    }
}
