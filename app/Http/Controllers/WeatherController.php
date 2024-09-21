<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $request->validate([
            'city' => 'required|alpha', // ensures the input is alphabetic
        ]);
        $apiKey = 'fe77f2d6f6bdb6c8359952ad8e665169';
        $apiUrl = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$apiKey}&units=metric&lang=en";
    
        try {
            $response = Http::get($apiUrl);
            
    
            if ($response->successful()) {
                $data = $response->json();

                $forecast = collect($data['list'])->groupBy(function ($item) {
                    return \Carbon\Carbon::parse($item['dt_txt'])->format('Y-m-d');
                });
                
                return view('weather.result', ['weather' => $data, 'city' => $city, 'forecast' => $forecast]);
            
            } else {
                return view('weather.result', ['error' => 'Не удалось получить данные о погоде. Попробуйте снова.']);
            }
        } catch (\Exception $e) {
            return view('weather.result', ['error' => 'Произошла ошибка при попытке получить данные.']);
        }
    }
}    