<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoHorario extends Model
{
    const CREATED_AT = 'date_time';
    const UPDATED_AT = null;

    protected $fillable = [
        'specialty_id',
        'professional_id',
        'name',
        'cpf',
        'source_id',
        'birthdate',
    ];
}
