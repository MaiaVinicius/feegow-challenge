<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSolicitacaoHorario;
use App\Models\SolicitacaoHorario;

class SolicitacaoHorarioController extends Controller
{

    public function store(StoreSolicitacaoHorario $request)
    {
        SolicitacaoHorario::create($request->all());
    }


}
