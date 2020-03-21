<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use App\Models\Schedule;

class HomeController
{
    private $specialtiesUrl;
    private $professionalsUrl;
    private $howKnowUrl;
    private $service;

    public function __construct()
    {
        $this->specialtiesUrl = config('feegow.endpoints.specialties');
        $this->professionalsUrl = config('feegow.endpoints.professionals');
        $this->howKnowUrl = config('feegow.endpoints.howknow');
        
        $this->service = new HttpService;
    }

    public function index()
    {
        $contentSpec = [];
        $contentHowKnow = [];
        
        try {
            $specialties = $this->service->get($this->specialtiesUrl);
            $howknows = $this->service->get($this->howKnowUrl);

            $statusCode = $specialties->status();

            $jsonSpec = $specialties->json();
            $contentSpec = $jsonSpec['content'];

            $jsonHowKnow = $howknows->json();
            $contentHowKnow = $jsonHowKnow['content'];

            return view('home')
                ->with('howknows', $contentHowKnow)
                ->with('specialties', $contentSpec);
        } catch (\Exception $ex) {
            $number = time();
            Log::error('SCHEDULE ERROR (' . $number . '): ' . $ex->getMessage());

            return view('home')
                ->with('howknows', $contentHowKnow)
                ->with('specialties', $contentSpec)
                ->withErrors(['error' => Lang::get('home.default_error') . $number]);
        }
    }

    public function getProfessionals(Request $request)
    {
        try {
            $id = $request->get('id');
            $vars = [
                'especialidade_id' => $id
            ];

            $professionals = $this->service->get($this->professionalsUrl, $vars);

            $json = $professionals->json();
            $content = $json['content'];
            
            return response()->json(['error' => 0, 'professionals' => $content, 'message' => '']);
        } catch (\Exception $ex) {
            $number = time();
            Log::error('AJAX ERROR (' . $number . '): ' . $ex->getMessage());
            
            return response()->json(['error' => 1, 'professionals' => null, 'message' => Lang::get('home.default_error') . $number]);
        }
    }
}