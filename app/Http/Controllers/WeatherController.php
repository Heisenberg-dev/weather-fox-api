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
        $apiKey = 'fe77f2d6f6bdb6c8359952ad8e665169';
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=ru";
    
        try {
            $response = Http::get($apiUrl);
            // dd($response->json());
    
            if ($response->successful()) {
                $data = $response->json();
                
                return view('weather.result', ['weather' => $data, 'city' => $city]);
            
            } else {
                return view('weather.result', ['error' => 'не удалось получить данные о погоде. Попробуйте снова.']);
            }
        } catch (\Exception $e) {
            return view('weather.result', ['error' => 'Произошла ошибка при попытке получить данные.']);
        }
    }
}    