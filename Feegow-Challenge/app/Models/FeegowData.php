<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeegowData extends Model
{
    protected $table = 'feegow_data';
    protected $fillable = [
        'name',
        'specialty_id',
        'professional_id',
        'cpf',
        'source_id',
        'birthdate',
    ];
}
