<?php

namespace App\Http\Controllers;

use App\Mode\User;
use App\Model\Professionals;
use App\Model\Schedule;
use App\Model\Specialties;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schedulesMade = [];
        $schedules = Schedule::all();
        $medicSearch = new Professionals();
        foreach ($schedules as $schedule)
        {
            if(empty($schedule->professional_id)){
                continue;
            }
            $medic = json_decode($medicSearch->getProfessionalSearchedFromApi($schedule->professional_id));
            $schedulesMade[] =
                array(
                    "name_medic" => $medic->content->informacoes[0]->nome,
                    "name" => $schedule->name,
                    "cpf" => $schedule->cpf,
                    "birth_date" => $schedule->birth_date
                );

        }

        return view('home')->with('schedule',$schedulesMade);
    }
}
