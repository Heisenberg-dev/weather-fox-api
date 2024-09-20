<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/', [WeatherController::class, 'index'])->name('weather.index');
Route::post('/weather', [WeatherController::class, 'fetchWeather'])->name('weather.fetch');
