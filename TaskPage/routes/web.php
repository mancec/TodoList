<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'TaskController@index');
Route::get('/tasks/create', 'TaskController@create');
Route::get('/tasks/edit/{task}', 'TaskController@edit');
Route::apiResource('/tasks', 'TaskController')->middleware('auth');