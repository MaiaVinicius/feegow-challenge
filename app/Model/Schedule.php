<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = ["specialty_id", "professional_id", "name","cpf","source_id","birth_date"];

}
