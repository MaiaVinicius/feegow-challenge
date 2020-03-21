<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use App\Models\Schedule;

class ScheduleController
{
    public function store(ScheduleRequest $request)
    {
        try {
            $schedule = new Schedule;
            $schedule->fill($request->all());
            
            if ($schedule->save())
            {
                return redirect()->action('HomeController@index')
                    ->with('message', Lang::get('schedule.save_successfully'));
            }
        } catch (\Exception $ex) {
            $number = time();
            Log::error('SCHEDULE ERROR (' . $number . '): ' . $ex->getMessage());
            
            return redirect()->action('HomeController@index')
                    ->withErrors(['error' => Lang::get('home.default_error') . $number]);
        }
    }
}