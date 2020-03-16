<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/tasks/create', 'TaskController@create')->middleware('auth');
Route::get('/tasks/edit/{task}', 'TaskController@edit')->middleware('auth');
Route::apiResource('/tasks', 'TaskController')->middleware('auth');

Route::get('/weather/city', 'WeatherController@selectCity')->middleware('auth');
Route::get('/weather', 'WeatherController@currentWeather')->middleware('auth');
Route::get('/weather/email', 'WeatherController@create')->middleware('auth');
Route::put('/weather/email', 'WeatherController@update')->middleware('auth');

Route::get('/alert', 'WeatherController@sendAlert')->middleware('auth');