<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/tasks/create', 'TaskController@create');
Route::get('/tasks/edit/{task}', 'TaskController@edit');
Route::apiResource('/tasks', 'TaskController')->middleware('auth');

Route::get('/weather/city', 'WeatherController@selectCity');
Route::get('/weather', 'WeatherController@currentWeather');
Route::get('/weather/email', 'WeatherController@create');
Route::put('/weather/email', 'WeatherController@update');

Route::get('/alert', 'WeatherController@sendAlert');