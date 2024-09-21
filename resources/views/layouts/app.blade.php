<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Weather App')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* Custom animation for fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out forwards;
        }
    </style>
</head>
<body class="bg-blue-100">
    <!-- Шапка приложения -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold">Weather App</h1>
            <img src="https://openweathermap.org/img/wn/@{{ $weather['weather'][0]['icon'] }}.png" alt="Weather icon" class="weather-icon">

        </div>
    </header>

    <!-- Основное содержимое -->
    <main class="container mx-auto py-8">
        @yield('content')
    </main>

    <!-- Подвал -->
    <footer class="bg-blue-600 text-white py-4 text-center">
        <p>&copy; 2024 Weather App</p>
    </footer>

    <!-- Подключение скриптов -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
