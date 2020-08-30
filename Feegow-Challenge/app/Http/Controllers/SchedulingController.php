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
}
