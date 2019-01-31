<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolicitacaoHorario extends FormRequest
{

    private $professionals;
    private $specialties;

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
            'specialty_id' => 'required|integer',
            'professional_id' => 'required|integer',
            'name' => 'required|max:100',
            'cpf' => 'required|cpf|formato_cpf|max:15',
            'source_id' => 'required|integer',
            'birthdate' => 'required|date'
        ];
    }
}
