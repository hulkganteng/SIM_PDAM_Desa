<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM PDAM Desa') }} - @yield('title', 'Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#1A3A5C] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    {{-- Elemen dekoratif air --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <svg class="absolute -bottom-10 left-0 w-full opacity-10" viewBox="0 0 1200 320" fill="none">
            <path d="M0 160C200 80 400 240 600 160C800 80 1000 240 1200 160V320H0V160Z" fill="#4FC3F7"/>
        </svg>
        <svg class="absolute -bottom-20 left-0 w-full opacity-[0.06]" viewBox="0 0 1200 320" fill="none">
            <path d="M0 200C200 120 400 280 600 200C800 120 1000 280 1200 200V320H0V200Z" fill="#4FC3F7"/>
        </svg>
        <div class="absolute top-16 right-20 w-64 h-64 rounded-full border border-white/10"></div>
        <div class="absolute top-28 right-32 w-40 h-40 rounded-full border border-white/5"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full bg-[#4FC3F7]/5"></div>
        <svg class="absolute top-1/4 left-16 w-8 h-8 text-[#4FC3F7]/20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C12 2 5 10.5 5 15a7 7 0 1014 0C19 10.5 12 2 12 2z"/>
        </svg>
        <svg class="absolute top-[40%] right-24 w-6 h-6 text-[#4FC3F7]/15" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C12 2 5 10.5 5 15a7 7 0 1014 0C19 10.5 12 2 12 2z"/>
        </svg>
    </div>

    {{-- Card login di tengah --}}
    <div class="relative z-10 w-full max-w-sm">
        {{-- Logo & Branding --}}
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#4FC3F7] mb-3 shadow-lg shadow-[#4FC3F7]/20">
                <svg class="w-6 h-6 text-[#1A3A5C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11l-2-2m0 0v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <h1 class="text-lg font-semibold text-white">SIM PDAM Desa</h1>
            <p class="text-[#93C5FD] mt-0.5 text-xs">Sistem Informasi Manajemen PDAM</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-xl p-6 shadow-xl shadow-black/10">
            <x-alert />
            @yield('content')
        </div>

        <p class="text-center text-xs text-white/40 mt-5">&copy; {{ date('Y') }} Pemerintah Desa. Semua hak dilindungi.</p>
    </div>
</body>
</html>
