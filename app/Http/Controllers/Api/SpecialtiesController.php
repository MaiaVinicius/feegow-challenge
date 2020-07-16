<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialtiesCollection;
use App\Repository\SpecialtiesRepository;

class SpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $specialtiesRepository = new SpecialtiesRepository();
            $specialties = $specialtiesRepository->list();

            return new SpecialtiesCollection($specialties);
        } catch (\Throwable $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
