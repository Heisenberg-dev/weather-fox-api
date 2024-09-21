@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    @if(isset($error))
        <p class="text-red-900 text-center">{{ $error }}</p>
        @elseif(isset($weather['main']))
        <!-- current weather-info -->
        <div id="weather-info" class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto transition-opacity duration-500 opacity-100">
            <h2 class="text-3xl font-semibold mb-4">The weather in {{ $city }}</h2>
            <p><strong>Temperature:</strong> {{ $weather['main']['temp'] }}°C</p>
            <p><strong>Feels like:</strong> {{ $weather['main']['feels_like'] }}°C</p>
            <p><strong>Humidity:</strong> {{ $weather['main']['humidity'] }}%</p>
            <p><strong>Wind speed:</strong> {{ $weather['wind']['speed'] }} m/s</p>
            <p><strong>Description:</strong> {{ $weather['weather'][0]['description'] }}</p>
        </div>
    @else
    
        <!-- 5-day Forecast -->
        <h3 class="text-2xl font-semibold text-center mt-8 mb-4">5-day weather forecast for
{{$city}}</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach ($forecast as $day => $items)
                @php
                    $dayForecast = $items->first(); // Get the first forecast of the day as a summary
                @endphp
                <div class="bg-blue-100 rounded-lg shadow-lg p-4">
                    <h4 class="text-lg font-bold">{{ \Carbon\Carbon::parse($day)->format('d M Y') }}</h4>
                    <p><strong>Temperature:</strong> {{ $dayForecast['main']['temp'] }}°C</p>
                    <p><strong>Description:</strong> {{ $dayForecast['weather'][0]['description'] }}</p>
                    <p><strong>Humidity:</strong> {{ $dayForecast['main']['humidity'] }}%</p>
                    <p><strong>Wind speed:</strong> {{ $dayForecast['wind']['speed'] }} m/s</p>
                </div>

           
            @endforeach
        </div>

    @endif


    <div class="text-center mt-6">
     
        <a href="{{ route('weather.index') }}" id="back-button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><strong>Check other city</strong></a>
    </div>
</div>



@endsection
