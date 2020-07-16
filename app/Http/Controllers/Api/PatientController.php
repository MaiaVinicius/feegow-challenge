<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientCollection;
use App\Repository\PatientRepository;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSource()
    {
        try {
            $patientRepository = new PatientRepository();
            $patients = $patientRepository->listSource();

            return new PatientCollection($patients);
        } catch (\Throwable $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
