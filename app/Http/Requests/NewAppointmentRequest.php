<?php

namespace App\Http\Requests;

use App\Rules\ValidateCPF;
use Illuminate\Foundation\Http\FormRequest;

class NewAppointmentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'specialty_id' => 'required|integer',
            'professional_id' => 'required|integer',
            'source_id' => 'required|integer',
            'cpf' => ['required', new ValidateCPF],
            'birthdate' => 'required|date',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->cpf)
        ]);
    }
}
