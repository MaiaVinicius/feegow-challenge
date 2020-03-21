<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use App\Models\Schedule;

class ScheduleRequest extends FormRequest
{
    private $schedule;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function __construct()
    {
        $this->schedule = new Schedule;
    }

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
        return $this->schedule->getRules();
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('schedule.name_required'),
            'name.string' => Lang::get('schedule.name_string'),
            'cpf.required' => Lang::get('schedule.cpf_required'),
            'cpf.string' => Lang::get('schedule.cpf_string'),
            'source_id.required' => Lang::get('schedule.source_id_required'),
            'birthdate.required' => Lang::get('schedule.birthdate_required'),
            'birthdate.date' => Lang::get('schedule.birthdate_date')
        ];
    }
}
