<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM PDAM Desa') }} - @yield('title', 'Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        {{-- Logo / App Name --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-600">SIM PDAM Desa</h1>
            <p class="text-gray-500 mt-2">Sistem Informasi Manajemen PDAM</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-lg shadow-md p-6 sm:p-8">
            <x-alert />
            @yield('content')
        </div>
    </div>
</body>
</html>
