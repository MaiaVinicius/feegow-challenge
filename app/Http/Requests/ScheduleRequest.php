<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'specialty_id' => 'required|int',
            'professional_id' => 'required|int',
            'name' => 'required|max:255',
            'cpf' => 'required',
            'source_id' => 'required|int',
            'birthdate' => 'required|date',
            'date_time' => 'required',
        ];
    }
}
