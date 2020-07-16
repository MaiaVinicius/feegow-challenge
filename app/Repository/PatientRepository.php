<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;

class PatientRepository
{
    public function listSource()
    {
        $response = Http::timeout(3)
                        ->retry(2)
                        ->withHeaders([
                            'Content-Type'      => 'application/json',
                            'x-access-token'    => env('FEEGOW_SECRET_API'),
                        ])->get('https://api.feegow.com.br/api/patient/list-sources');

        if($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }
}