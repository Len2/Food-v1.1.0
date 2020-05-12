<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class CreateReservationRequest extends FormRequest
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
            'user_id' => 'required',
            'table_id' => 'required',
            'page_id' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number_of_persons' => 'required',
        ];
    }
}
