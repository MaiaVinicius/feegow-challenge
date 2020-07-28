<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitacoes;

class SiteController extends Controller
{
    /**
     * exibe a página home da aplicação
     */
    public function index() {
        return view('home');
    }

    /**
     * Exibe a página de solicitações juntamente com todas as solicitações
     */
    public function indexSolicitacoes() {
        $sols = Solicitacoes::all();

        return view('solicitacoes', compact('sols'));
    }

    /**
     * É a função que é executada ao se requisitar os profissionais da especialidade desejada no select
     * da página "home".
     */
    public function search(Request $request) {
        $espec = $request->espec;
        $especId = $request->especId;

        return view('professionals', compact('espec', 'especId'));
    }

    /**
     * É a função que é executada ao clicar em solicitar horários dentro do modal de agendamento. Essa função
     * salva todos os dados enviados pela requisição ajax que está dentro da função javascript agendamento(),
     * que está dentro da página "professionals"; a solicitação é enviada e salva no banco de dados mysql.
     */
    public function solicity(Request $request) {

        $solicity = new Solicitacoes();

        $solicity->specialty_id = $request->input('specialty_id');
        $solicity->professional_id = $request->input('professional_id');
        $solicity->name = $request->input('name');
        $solicity->especialty = $request->input('espec');
        $solicity->cpf = $request->input('cpf');
        $solicity->source_id = $request->input('source_id');
        $solicity->birthdate = $request->input('birthdate');
        $solicity->save();

        return response('ok', 200);
    }
}
