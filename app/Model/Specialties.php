<?php

namespace App\Model;

use App\Helpers\HandleRequest;
use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    //

    public function getSpecialtiesFromApi()
    {
        return HandleRequest::getRequest('https://api.feegow.com.br/api/specialties/list');
    }
}
