<?php

namespace App\Model;

use App\Helpers\HandleRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Professionals extends Model
{
    //

    public function getProfessionalsFromApi(Request $request)
    {
        return HandleRequest::getRequest('https://api.feegow.com.br/api/professional/list?especialidade_id='.$request->especialidade_id);
    }
    public function getProfessionalSearchedFromApi($id)
    {
        return HandleRequest::getRequest('https://api.feegow.com.br/api/professional/search?profissional_id='.$id);
    }


}
