<?php

namespace App\Http\Controllers;
use App\agendarHorarioModel;

use Illuminate\Http\Request;

class agendarHorarioController extends Controller
{
    public function agendarHorario(Request $request){
        return agendarHorarioModel::create($request['data']);
    }
}
