<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'appointments';
   
    /**
    * The attributes that are mass assignable.
    *
    * @var string
    */
    protected $fillable = [
        'name',
        'specialty_id',
        'professional_id',
        'source_id',
        'cpf',
        'birthdate',
   ];

}
