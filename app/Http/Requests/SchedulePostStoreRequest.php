<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SchedulePostStoreRequest extends FormRequest
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
            'name' => 'required|min:2|max:190|string',
            'birthdate' => 'required|date',
            'source_id' => 'required|integer',
            'specialty_id' => 'nullable|integer',
            'professional_id' => 'required|integer',
            'cpf' => 'required|string|size:11',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
