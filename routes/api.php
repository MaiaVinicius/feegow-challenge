<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('specialties', 'HomeController@specialtiesList');
Route::get('professionals', 'HomeController@professionalsList');
Route::get('sources', 'HomeController@sourcesList');
Route::resource('schedule', 'ScheduleController', ['only' => [
    'store',
    'update',
    'destroy',
]]);
