<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $feegowApiEndpoint = 'http://clinic5.feegow.com.br/components/public/api';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(response($this->curlApiCall($this->feegowApiEndpoint, 'specialties/list')));
        return view('home');
    }

    public function specialtiesList()
    {
        return response()->json($this->curlApiCall($this->feegowApiEndpoint, 'specialties/list'));
    }

    public function professionalsList(Request $request)
    {
        $specialty_id = $request->get('especialidade_id');
        $list = json_decode($this->curlApiCall(
            $this->feegowApiEndpoint,
            'professional/list',
            [
                'ativo' => 1,
                // 'especialidade_id' => $specialty_id,
            ]
        ), true);
        // dump($list);
        if ($list['success']) {
            $list['content'] = array_where($list['content'], function ($value, $key) use ($specialty_id) {
                $specialties_id_list = data_get($value, 'especialidades.*.especialidade_id');
                // dump($specialties_id_list);
                return !empty($value['nome'])
                    && !empty($value['conselho'])
                    && !empty($value['documento_conselho'])
                    && (
                        !empty($specialty_id) ?
                        in_array($specialty_id, $specialties_id_list ? $specialties_id_list : []) :
                        true
                    );
            });
        }
        // dd($list);
        return response()->json($list);
    }
}
