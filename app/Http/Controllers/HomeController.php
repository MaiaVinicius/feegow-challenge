<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Services\FeegowAPIService;

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
        $feegowAPI = new FeegowAPIService();

        $specialtyList = $feegowAPI->specialtyList();

        return view('home', [
            'specialtyList' => $specialtyList
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appointmentList()
    {
        $appointmentList = Appointment::all();

        return view('appointmentList', [
            'appointmentList' => $appointmentList
        ]);
    }
}
