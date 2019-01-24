<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthdate',
        'source_id',
        'specialty_id',
        'professional_id',
        'user_id',
        'cpf',
        'date_time',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birthdate',
        'date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
