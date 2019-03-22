<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = ['specialty_id', 'professional_id', 'name', 'cpf', 'source_id', 'birthdate','date_time'];

}
