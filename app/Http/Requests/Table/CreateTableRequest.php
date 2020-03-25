<?php

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class CreateTableRequest extends FormRequest
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
            'table_number'=>'required|regex:/^[0-9]+$/',
            'nr_chairs'=>'regex:/^[0-9]+$/',
            'status'=>'required|in:available,busy',
            'type_of_table'=>'required|in:food,drink',
            'page_id'=>'required|regex:/^[0-9]+$/'
        ];
    }
}
