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
<body class="bg-[#EEF2F7] min-h-screen" x-data="{ mobileMenuOpen: false }">
    @php
        $portalLinks = [
            ['url' => '/portal/tagihan', 'pattern' => 'portal/tagihan*', 'label' => 'Tagihan'],
            ['url' => '/portal/pemakaian', 'pattern' => 'portal/pemakaian*', 'label' => 'Pemakaian'],
            ['url' => '/portal/pembayaran', 'pattern' => 'portal/pembayaran*', 'label' => 'Pembayaran'],
            ['url' => '/portal/pengaduan', 'pattern' => 'portal/pengaduan*', 'label' => 'Pengaduan'],
            ['url' => '/portal/profil', 'pattern' => 'portal/profil*', 'label' => 'Profil'],
        ];
    @endphp

    {{-- Navbar horizontal sticky --}}
    <nav class="bg-[#1A3A5C] sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo --}}
                <a href="{{ url('/portal/tagihan') }}" class="flex items-center gap-3">
                    <span class="flex-shrink-0 w-9 h-9 rounded-lg bg-[#4FC3F7] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#1A3A5C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11l-2-2m0 0v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span class="text-white font-semibold text-base">SIM PDAM Desa</span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-1">
                    @foreach($portalLinks as $link)
                        @php $active = request()->is($link['pattern']); @endphp
                        <a href="{{ url($link['url']) }}"
                           class="px-3 py-2 text-sm font-medium border-b-2 transition-colors
                                  {{ $active ? 'text-white border-[#4FC3F7]' : 'text-[#93C5FD] border-transparent hover:text-white' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    <form method="POST" action="{{ url('/logout') }}" class="ml-4 pl-4 border-l border-white/20">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-lg text-sm font-medium text-[#93C5FD] hover:bg-[#2D5A8A] hover:text-white transition-colors">
                            Logout
                        </button>
                    </form>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-[#93C5FD] hover:text-white hover:bg-[#2D5A8A] focus:outline-none" aria-label="Buka menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile dropdown menu --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition class="md:hidden bg-[#0F2740]">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @foreach($portalLinks as $link)
                    @php $active = request()->is($link['pattern']); @endphp
                    <a href="{{ url($link['url']) }}"
                       class="block px-3 py-2 rounded-lg text-base font-medium transition-colors
                              {{ $active ? 'bg-[#2D5A8A] text-white' : 'text-[#93C5FD] hover:bg-[#2D5A8A] hover:text-white' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <form method="POST" action="{{ url('/logout') }}" class="border-t border-white/10 pt-2 mt-2">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-base font-medium text-[#93C5FD] hover:bg-[#2D5A8A] hover:text-white">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-alert />
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
