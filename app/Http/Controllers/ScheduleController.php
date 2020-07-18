<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Schedule;

class ScheduleController extends Controller
{
  public function index()
  {
    return Schedule::all();
  }

  public function store(ScheduleRequest $request)
  {
    $validatedData = $request->validated();

    return Schedule::create($validatedData);
  }

  public function update(ScheduleRequest $request, $id)
  {
    $Schedule = Schedule::find($id);
    $Schedule->update($request->all());
  }
}
