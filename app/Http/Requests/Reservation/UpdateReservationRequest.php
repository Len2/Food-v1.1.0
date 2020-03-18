<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'user_id' => 'regex:/^[0-9]+$/',
            'table_id' => 'regex:/^[0-9]+$/',
            'page_id' => 'regex:/^[0-9]+$/',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number_of_persons' => 'regex:/^[0-9]+$/',
        ];
    }
}
