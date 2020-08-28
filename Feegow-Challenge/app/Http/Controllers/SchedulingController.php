<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FeegowClinicRepository;

class SchedulingController extends Controller
{
      /**
     * @var FeegowClinicRepository
     */
    private $scheduling;

    /**
     * SchedulingController constructor.
     * @param FeegowClinicRepository $scheduling
     */
    public function __construct(FeegowClinicRepository $clinic)
    {
        $this->scheduling = $clinic;
    }

    public function index()
    {
        $specialties = $this->scheduling->specialty();
        return $specialties;
    }

    public function professional()
    {
        $professional = $this->scheduling->professional();
        return $professional;
    }

    public function sources()
    {
        $sources = $this->scheduling->sources();
        return $sources;
    }
}
