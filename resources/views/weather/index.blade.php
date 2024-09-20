@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-8">Проверить погоду</h1>

    <form action="{{ route('weather.get') }}" method="POST" class="flex justify-center mb-8">
    @csrf
    <input
        type="text"
        name="city"
        placeholder="Введите город"
        class="border rounded p-2 w-1/3 mr-4"
        value="{{ old('city') }}"
    />
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Узнать погоду</button>
</form>


    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif

    @isset($weather)
    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Погода в {{ $city }}</h2>
        <p class="text-gray-700 text-lg">Температура: {{ $weather['main']['temp'] }}°C</p>
        <p class="text-gray-700 text-lg">Ощущается как: {{ $weather['main']['feels_like'] }}°C</p>
        <p class="text-gray-700 text-lg">Влажность: {{ $weather['main']['humidity'] }}%</p>
        <p class="text-gray-700 text-lg">Скорость ветра: {{ $weather['wind']['speed'] }} м/с</p>
    </div>
    @endisset
</div>
@endsection
