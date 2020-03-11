<?php


namespace App\Model;


use App\Helpers\HandleRequest;

class Utilities
{
    public function getSelectOptions()
    {
        return HandleRequest::getRequest('https://api.feegow.com.br/api/patient/list-sources');
    }
}
