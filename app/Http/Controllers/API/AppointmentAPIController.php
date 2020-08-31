<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewAppointmentRequest;

class AppointmentAPIController extends Controller
{

    /**
    * Patient sources list
    *
    * @return json
    */
    public function newAppoint(NewAppointmentRequest $request)
    {
        $appointment = new Appointment($request->all());
        $appointment->saveOrFail();
        // Validate and save on database

        return response()->json($appointment);

    }
}
