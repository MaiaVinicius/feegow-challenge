<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $fillable = [
        'specialty_id',
        'professional_id',
        'name',
        'cpf',
        'source_id',
        'birthdate',
        'status'
    ];

    private $rules = [
        'specialty_id' => 'integer|required',
        'professional_id' => 'integer|required',
        'name' => 'string|required',
        'cpf' => 'string|required',
        'source_id' => 'integer|required',
        'birthdate' => 'date|required',
        'status' => 'integer'
    ];

    public function getRules()
    {
        return $this->rules;
    }
}
