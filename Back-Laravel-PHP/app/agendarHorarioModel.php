<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agendarHorarioModel extends Model
{
    protected $fillable = [
        'id' 
        ,'specialty_id'
        ,'profissional_id'
        ,'cpf'
        ,'listsources'
        ,'birthdate'
        ,'nome'
        ,'create_at'
        ,'updated_at'
    ];

    protected $table = 'agendarHorario';
}
