<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'SiteController@index');
Route::get('/solicitacoes', 'SiteController@indexSolicitacoes');

Route::post('/pro', 'SiteController@search');
Route::post('/solicity', 'SiteController@solicity');
