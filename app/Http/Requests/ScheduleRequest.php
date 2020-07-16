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
            'specialty_id'              => ['required', 'numeric'],
            'professional_id'           => ['required', 'numeric'],
            'name'                      => ['required', 'string', 'max:200'],
            'cpf'                       => ['required', 'numeric'],
            'source_id'                 => ['required', 'numeric'],
            'birthdate'                 => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
