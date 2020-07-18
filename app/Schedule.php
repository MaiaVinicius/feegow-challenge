<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  public $fillable = [
    'specialty_id',
    'professional_id',
    'source_id',
    'name',
    'cpf',
    'birthdate',
    'date_time'
  ];

  public $timestamps = false;
}
