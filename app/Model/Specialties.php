<?php

namespace App\Model;

use App\Helpers\HandleRequest;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Specialties extends Model
{
    //

    public function getSpecialtiesFromApi()
    {

        return HandleRequest::getRequest('https://api.feegow.com.br/api/specialties/list');
    }
}
