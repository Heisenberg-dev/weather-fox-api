@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    @if(isset($error))
        <p class="text-red-900 text-center">{{ $error }}</p>
    @else
        <!-- Current Weather Info -->
        <div id="weather-info" class="bg-white shadow-md rounded-lg p-6 max-w-max mx-auto transition-opacity duration-500 opacity-100">
            <h2 class="text-3xl font-semibold mb-4">5-Day Forecast for {{ $city }}</h2>

            <div class="flex flex-wrap justify-between space-x-4">
                <!-- Loop through the daily forecast data -->
                @foreach($weather as $forecast)
                <div class="w-full md:w-1/5 bg-white p-4 rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-bold">{{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('d M Y H:i') }}</h3>
                    <p><strong>Temperature:</strong> {{ $forecast['main']['temp'] }}°C</p>
                    <p><strong>Feels Like:</strong> {{ $forecast['main']['feels_like'] }}°C</p>
                    <p><strong>Humidity:</strong> {{ $forecast['main']['humidity'] }}%</p>
                    <p><strong>Conditions:</strong> {{ $forecast['weather'][0]['description'] }}</p>
                    <p><strong>Wind Speed:</strong> {{ $forecast['wind']['speed'] }} m/s</p>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Air Quality Info -->
@if(isset($airQuality))
    <div id="air-quality-info" class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto mt-6 transition-opacity duration-500 opacity-100">
        <h2 class="text-3xl font-semibold mb-4">Air Quality in {{ $city }}</h2>

        @php
            $aqi = $airQuality['list'][0]['main']['aqi'];  // Air Quality Index
            $aqiText = '';

            switch ($aqi) {
                case 1:
                    $aqiText = 'Very Good';
                    break;
                case 2:
                    $aqiText = 'Good';
                    break;
                case 3:
                    $aqiText = 'Moderate';
                    break;
                case 4:
                    $aqiText = 'Poor';
                    break;
                case 5:
                    $aqiText = 'Very Poor';
                    break;
            }
        @endphp

        <p><strong>Air Quality Index (AQI):</strong> {{ $aqi }} ({{ $aqiText }})</p>
        <p><strong>PM2.5:</strong> {{ $airQuality['list'][0]['components']['pm2_5'] }} μg/m³</p>
        <p><strong>PM10:</strong> {{ $airQuality['list'][0]['components']['pm10'] }} μg/m³</p>
        <p><strong>CO:</strong> {{ $airQuality['list'][0]['components']['co'] }} μg/m³</p>
        <p><strong>NO:</strong> {{ $airQuality['list'][0]['components']['no'] }} μg/m³</p>
        <p><strong>NO2:</strong> {{ $airQuality['list'][0]['components']['no2'] }} μg/m³</p>
    </div>
@endif

<div class="text-center mt-6">
    <a href="{{ route('weather.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Check Another City</a>
</div>
@endsection
