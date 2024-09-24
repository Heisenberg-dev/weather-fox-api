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
            // Fetch weather data
            $weatherResponse = Http::get($apiUrl);
            
            // Проверим успешность запроса и существование данных
            if ($weatherResponse->successful() && !isset($weatherResponse['cod']) || $weatherResponse['cod'] != '404') {
                $weatherData = $weatherResponse->json();
                
                $dailyForecasts = collect($weatherData['list'])->filter(function ($forecast) {
                    return \Carbon\Carbon::parse($forecast['dt_txt'])->format('H:i') === '12:00'; 
                });
               
                // Extract coordinates from the first item in the list
                $lat = $weatherData['city']['coord']['lat'];
                $lon = $weatherData['city']['coord']['lon'];
                
                // Fetch air quality data
                $airQualityApiUrl = "http://api.openweathermap.org/data/2.5/air_pollution?lat={$lat}&lon={$lon}&appid={$apiKey}";
                $airQualityResponse = Http::get($airQualityApiUrl);
                
                if ($airQualityResponse->successful()) {
                    $airQualityData = $airQualityResponse->json();
                    
                    // Передаем данные о погоде и качестве воздуха
                    return view('weather.result', [
                        'weather' => $dailyForecasts, 
                        'airQuality' => $airQualityData,
                        'city' => $city
                    ]);
                } else {
                    // Ошибка при получении данных о качестве воздуха
                    return view('weather.result', ['error' => 'Unable to obtain air quality data.', 'city' => $city]);
                }
            } else {
                // Ошибка, если город не найден
                return view('weather.result', ['error' => "City '{$city}' does not exist."]);
            }
        } catch (\Exception $e) {
            // Общая ошибка
            return view('weather.result', ['error' => 'An error occurred while trying to retrieve data.', 'city' => $city]);
        }
    }
}    