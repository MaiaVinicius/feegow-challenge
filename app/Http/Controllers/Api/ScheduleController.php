<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleCollection;
use App\Repository\ScheduleRepository;
use App\Schedule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $scheduleRepository = new ScheduleRepository($this->schedule);
            
            if($request->has("coditions")) {
                $scheduleRepository->selectCoditions($request->coditions);
            }

            if($request->has("fields")) {
                $scheduleRepository->selectFilter($request->fields);
            }

            return new ScheduleCollection($scheduleRepository->getResult()->paginate(10));
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        try {
            $this->schedule->create($request->all());
            $message = new ApiMessages("Schedule sucessfully created");

            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
