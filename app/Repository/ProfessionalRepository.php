<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;

class ProfessionalRepository
{
    public function listBySpecialty($request)
    {
        $response = Http::timeout(3)
                        ->retry(2)
                        ->withHeaders([
                            'Content-Type'      => 'application/json',
                            'x-access-token'    => env('FEEGOW_SECRET_API'),
                        ])->get('https://api.feegow.com.br/api/professional/list', [
                            'especialidade_id'  => $request->specialty,
                        ]);

        if($response->successful()) {
            return $response->json();
        }

        return $response->throw()->json();
    }
}