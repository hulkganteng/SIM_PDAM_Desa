<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM PDAM Desa') }} - @yield('title', 'Portal Pelanggan')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ mobileMenuOpen: false }">
    {{-- Top Navigation --}}
    <nav class="bg-indigo-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ url('/portal/tagihan') }}" class="text-white font-bold text-lg">SIM PDAM Desa</a>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ url('/portal/tagihan') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('portal/tagihan*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }} transition-colors">
                        Tagihan
                    </a>
                    <a href="{{ url('/portal/pembayaran') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('portal/pembayaran*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }} transition-colors">
                        Pembayaran
                    </a>
                    <a href="{{ url('/portal/pengaduan') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('portal/pengaduan*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }} transition-colors">
                        Pengaduan
                    </a>
                    <a href="{{ url('/portal/profil') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('portal/profil*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }} transition-colors">
                        Profil
                    </a>

                    <div class="ml-4 border-l border-indigo-400 pl-4">
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium text-indigo-100 hover:bg-indigo-500 hover:text-white transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md text-indigo-100 hover:text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white" aria-label="Toggle menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-indigo-500">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ url('/portal/tagihan') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('portal/tagihan*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }}">
                    Tagihan
                </a>
                <a href="{{ url('/portal/pembayaran') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('portal/pembayaran*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }}">
                    Pembayaran
                </a>
                <a href="{{ url('/portal/pengaduan') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('portal/pengaduan*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }}">
                    Pengaduan
                </a>
                <a href="{{ url('/portal/profil') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('portal/profil*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-500 hover:text-white' }}">
                    Profil
                </a>
                <form method="POST" action="{{ url('/logout') }}" class="border-t border-indigo-500 pt-2 mt-2">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-indigo-100 hover:bg-indigo-500 hover:text-white">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-alert />
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
