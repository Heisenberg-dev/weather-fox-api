@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
@if(isset($error))
    <p class="text-red-500 text-center">{{ $error }}</p>
@endif

    <h1 class="text-3xl font-bold text-center mb-8">Погода в {{ $city }}</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Погода в {{ $city }}</h2>
        <p class="text-gray-700 text-lg">Температура: {{ $weather['main']['temp'] }}°C</p>
        <p class="text-gray-700 text-lg">Ощущается как: {{ $weather['main']['feels_like'] }}°C</p>
        <p class="text-gray-700 text-lg">Влажность: {{ $weather['main']['humidity'] }}%</p>
        <p class="text-gray-700 text-lg">Скорость ветра: {{ $weather['wind']['speed'] }} м/с</p>
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('weather.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Проверить другой город</a>
    </div>
</div>
@endsection
