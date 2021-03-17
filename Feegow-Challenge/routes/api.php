<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('specialties', "SchedulingController@specialties")->name('specialties');
Route::get('professional', "SchedulingController@professional")->name('professional');
Route::get('sources', "SchedulingController@sources")->name('sources');
Route::post('store', "SchedulingController@store")->name('store');
