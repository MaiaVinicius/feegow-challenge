<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalRequest;
use App\Http\Resources\ProfessionalCollection;
use App\Repository\ProfessionalRepository;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProfessionalRequest $request)
    {
        try {
            $professionalRepository = new ProfessionalRepository();

            $professionals = $professionalRepository->listBySpecialty($request);

            return new ProfessionalCollection($professionals);
        } catch (\Throwable $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
