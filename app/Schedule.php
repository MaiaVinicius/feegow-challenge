<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'specialty_id', 
        'professional_id', 
        'name', 
        'cpf', 
        'source_id', 
        'birthdate',
    ];
}
