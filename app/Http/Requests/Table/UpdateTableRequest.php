<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTableRequest extends FormRequest
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
            'number' => 'regex:/^[0-9]+$/',
            'nr_chairs' => 'regex:/^[0-9]+$/',
            'status' => 'in:available,busy',
            'type_of_table' => 'in:food,drink',
            'page_id' => 'regex:/^[0-9]+$/'
        ];
    }
}
