<?php

Route::get('/', 'PagesController@index');
Route::get('/search', 'PagesController@search');
Route::post('/schedule', 'PagesController@doSchedule');
