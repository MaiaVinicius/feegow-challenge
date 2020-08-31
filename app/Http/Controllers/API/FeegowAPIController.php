<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\FeegowAPIService;
use Illuminate\Http\Request;
use Throwable;

class FeegowAPIController extends Controller
{

    /** @var FeegowAPIService $feegowAPI */
    private $feegowAPI;

    public function __construct(FeegowAPIService $feegowAPI)
    {
        $this->feegowAPI = $feegowAPI;
    }

    /**
    * Search the professionals list from FeegowAPI
    *
    * @return json
    */
    public function professional(Request $request)
    {
        try {
            return response()->json($this->feegowAPI->professional($request->query()));
        } catch(Throwable $t) {
            info($t->getMessage());
        }
    }

    /**
    * Patient sources list
    *
    * @return json
    */
    public function patientSources()
    {
        try {
            return response()->json($this->feegowAPI->patientSources());
        } catch(Throwable $t) {
            info($t->getMessage());
        }
    }

}
