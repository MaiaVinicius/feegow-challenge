<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function formView()
    {
        return view('schedule.view');
    }
}
