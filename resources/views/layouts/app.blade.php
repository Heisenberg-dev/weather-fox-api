<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Weather App')</title>
    <!-- Подключение стилей -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-blue-100">
    <!-- Шапка приложения -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold">Weather App</h1>
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
