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
}
