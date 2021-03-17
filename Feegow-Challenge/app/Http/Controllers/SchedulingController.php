<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FeegowClinicRepository;
use App\Models\FeegowData;

class SchedulingController extends Controller
{
      /**
     * @var FeegowClinicRepository
     */
    private $scheduling;

    /**
     * SchedulingController constructor.
     * @param FeegowClinicRepository $scheduling
     */
    public function __construct(FeegowClinicRepository $clinic)
    {
        $this->scheduling = $clinic;
    }

    public function specialties()
    {
       $specialties = $this->scheduling->specialty();
        return response()->Json([
            'specialties' => $specialties,
            'res' => ' O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    public function professional()
    {
        $professional = $this->scheduling->professional();
        return response()->Json([
            'professional' => $professional,
            'res' => ' O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    public function sources()
    {
        $sources = $this->scheduling->sources();
        return response()->Json([
            'sources' => $sources,
            'res' => ' O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm =  $request->all();
                                  
            if (isset($dataForm)) {
                $item = new FeegowData($dataForm);
                  $item->save();
                return response()->Json([
                  'res'=>'O recurso informado foi criado com sucesso.'
                ], 201);
            }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422);     
    }
}
