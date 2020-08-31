<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/professional/list', 'API\FeegowAPIController@professional');
Route::get('/patient/list-sources', 'API\FeegowAPIController@patientSources');
Route::post('/appoints/new-appoint', 'API\AppointmentAPIController@newAppoint');

