<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('index', "SchedulingController@index")->name('index');
Route::get('professional', "SchedulingController@professional")->name('professional');
Route::get('sources', "SchedulingController@sources")->name('sources');
