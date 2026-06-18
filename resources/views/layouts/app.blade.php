<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM PDAM Desa') }} - @yield('title', 'Dashboard')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#EEF2F7] min-h-screen" x-data="{ sidebarOpen: false }">
    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Mobile sidebar overlay --}}
    <div x-show="sidebarOpen"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-30 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    {{-- Main Content --}}
    <div class="flex flex-col min-h-screen lg:ml-64">
        {{-- Topbar --}}
        <header class="sticky top-0 z-20 h-14 bg-white border-b border-[#E2E8F0]">
            <div class="flex items-center justify-between h-full px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 min-w-0">
                    {{-- Mobile hamburger --}}
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 rounded-lg text-[#64748B] hover:bg-[#EEF2F7] focus:outline-none" aria-label="Buka menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-base sm:text-lg font-semibold text-[#1A3A5C] truncate">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-2 sm:gap-4">
                    {{-- Notifikasi --}}
                    <a href="{{ url('/pengaduan') }}" class="relative p-2 rounded-lg text-[#64748B] hover:bg-[#EEF2F7] transition-colors" title="Notifikasi" aria-label="Notifikasi">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </a>

                    {{-- Avatar --}}
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block leading-tight">
                            <p class="text-sm font-medium text-[#1A3A5C]">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-[#64748B] capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-[#1A3A5C] flex items-center justify-center">
                            <span class="text-sm font-semibold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <x-alert />
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
