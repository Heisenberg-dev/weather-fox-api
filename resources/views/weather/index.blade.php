@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-8">Weather Forecast</h1>

    <form action="{{ route('weather.get') }}" method="POST" class="flex justify-center mb-8">
        @csrf
        <input
            type="text"
            name="city"
            placeholder="Type the city"
            class="border rounded p-2 w-1/3 mr-4 transition duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
            value="{{ old('city') }}"
        />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded transition transform duration-200 hover:bg-blue-600 hover:scale-105"><strong>Find out the weather</strong></button>
    </form>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif

    @isset($weather)
    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200 transition-opacity duration-500 opacity-0 animate-fadeIn">
        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Weather in{{ $city }}</h2>
        <p class="text-gray-700 text-lg">Temperature: {{ $weather['main']['temp'] }}°C</p>
        <p class="text-gray-700 text-lg">Feels like: {{ $weather['main']['feels_like'] }}°C</p>
        <p class="text-gray-700 text-lg">Humidity: {{ $weather['main']['humidity'] }}%</p>
        <p class="text-gray-700 text-lg">Wind speed: {{ $weather['wind']['speed'] }} м/с</p>
    </div>
    @endisset
</div>
@endsection
