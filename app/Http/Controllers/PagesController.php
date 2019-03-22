<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\Library\Services\FeegowApi;
use Mockery\Exception;


class PagesController extends Controller
{
    public $feegowApi;

    public function __construct(FeegowApi $feegowApi)
    {
        $this->feegowApi = $feegowApi;
    }

    protected function _getSpecialties(){
        $return = [];

        $urlPath = '/specialties/list';
        $specialties = $this->feegowApi->getService($urlPath, 'GET');

        if(!empty($specialties) && $specialties->success === true){
            $return = $specialties->content;
        }

        return $return;
    }

    protected function _getDoctors($specialty_id){
        $return = [];

        if(!empty($specialty_id) && is_numeric($specialty_id) && $specialty_id > 0){
            $urlPath = '/professional/list?specialty_id='.$specialty_id;
            $doctors = $this->feegowApi->getService($urlPath, 'GET');

            if(!empty($doctors) && $doctors->success === true){
                $return = $doctors->content;
            }
        }

        return $return;
    }

    protected function _getSources(){
        $return = [];

        $urlPath = '/patient/list-sources';
        $sources = $this->feegowApi->getService($urlPath, 'GET');

        if(!empty($sources) && $sources->success === true){
            $return = $sources->content;
        }

        return $return;
    }


    public function index()
    {
        $specialties = $this->_getSpecialties();
        $sources = $this->_getSources();

        return view('index', compact('specialties', 'sources'));

    }

    public function search(Request $request)
    {
        $specialty_id = $request->get('specialty_id');

        $doctors = $this->_getDoctors($specialty_id);

        return view('elements.doctors', compact('doctors'));
    }



    public function doSchedule(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();

            if(
                !empty($data)
                && !empty($data['specialty_id'])
                && !empty($data['professional_id'])
                && !empty($data['name']) && strlen (trim($data['name'])) > 3
                && !empty($data['cpf'])
                && !empty($data['source_id'])
                && !empty($data['birthdate'])

            ){

                list($d, $m, $y) = explode('/',$data['birthdate']);
                $data['birthdate'] = sprintf('%04d-%02d-%02d',$y,$m,$d);

                $data['cpf'] = preg_replace( '/[^0-9]/', '', $data['cpf']);


                try {
                    Schedule::create($data);
                } catch (Exception $e) {
                    return json_encode(['success'=> false, 'message'=> 'Falha ao gravar dados.', "content"=> []]);
                }

                return json_encode(['success'=> true, 'message'=> 'Agendamento realizado com sucesso!', "content"=> []]);
            }

            return json_encode(['success'=> false, 'message'=> 'Dados Inválido', "content"=> []]);
        }

        return json_encode(['success'=> false, 'message'=> 'Operação Inválida', "content"=> []]);
    }

}
