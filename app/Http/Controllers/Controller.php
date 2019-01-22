<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function curlApiCall($endpoint, $urlMethodPath)
    {
        $curl = curl_init("$endpoint/$urlMethodPath");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json' ,
                'x-access-token: ' . env('FEEGOW_API_TOKEN'), // Inject the token into the header
            ]
        );
        $output = curl_exec($curl);
        curl_close($curl);

        return json_encode($output, true);
    }
}
