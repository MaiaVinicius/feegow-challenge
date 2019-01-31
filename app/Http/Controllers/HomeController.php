<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Services\FeeGowAPIService\FeeGowAPIService;

class HomeController extends Controller
{
    public $client;

    public function __construct()
    {
        $this->client = new FeeGowAPIService();
    }

    public function index()
    {
        $specialities = collect(($this->client->get(FeeGowAPIService::URL_LIST_SPECIALTIES))->content);
        $specialities = $specialities->sortBy("nome");
        $sources = collect(($this->client->get(FeeGowAPIService::URL_LIST_SOURCES))->content);
        $sources = $sources->sortBy("nome_origem");
        return view('welcome',[
            'specialities' => [""=>""] + $specialities->pluck('nome','especialidade_id')->toArray(),
            'sources' => $sources->pluck('nome_origem','origem_id')->toArray()
        ]);
    }

    public function getProfessionalBySpeciality($id)
    {
        $queryString = ['especialidade_id' => $id, 'ativo' => 1];
        $response = $this->client->get(FeeGowAPIService::URL_LIST_PROFESSIONALS, $queryString);
        $professionals = array_filter($response->content, function(&$item){
            if(!is_null($item->nome)) {
                $prefix = $item->sexo == 'Masculino' ? 'Dr.' : 'Dra.';
                $item->nome = $prefix . ' ' . CustomHelper::formataNome($item->nome);
            }
            return is_null($item->nome) ? false : true;
        });
        return response()->json($professionals);
    }


}
