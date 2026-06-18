@php
    $user = auth()->user();

    // Hitung pengaduan baru untuk badge counter (hanya admin yang melihat menu pengaduan).
    $pengaduanBaru = 0;
    if ($user && $user->isAdmin()) {
        $pengaduanBaru = \App\Models\Pengaduan::where('status', 'baru')->count();
    }

    // Helper kelas nav item.
    $navBase = 'flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors';
    $navActive = 'bg-[#2D5A8A] text-white';
    $navIdle = 'text-[#93C5FD] hover:bg-[#2D5A8A] hover:text-white';
@endphp

<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-[#1A3A5C] transform transition-transform duration-300 ease-in-out lg:translate-x-0"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="flex flex-col h-full">
        {{-- Logo + Nama Desa --}}
        <div class="flex items-center justify-between h-14 px-4 border-b border-white/10">
            <div class="flex items-center gap-3 min-w-0">
                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-[#4FC3F7] flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1A3A5C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11l-2-2m0 0v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white leading-tight truncate">SIM PDAM Desa</p>
                    <p class="text-xs text-[#93C5FD] leading-tight truncate">Sistem Informasi PDAM</p>
                </div>
            </div>
            <button @click="sidebarOpen = false" class="lg:hidden p-1 text-[#93C5FD] hover:text-white focus:outline-none" aria-label="Tutup sidebar">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-6 sidebar-scroll">
            @if($user->isAdmin())
                {{-- Utama --}}
                <div class="space-y-1">
                    <p class="px-3 mb-1 text-xs font-semibold uppercase tracking-wide text-[#4FC3F7]/70">Utama</p>
                    <a href="{{ url('/dashboard') }}" class="{{ $navBase }} {{ request()->is('dashboard') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </div>

                {{-- Manajemen --}}
                <div class="space-y-1">
                    <p class="px-3 mb-1 text-xs font-semibold uppercase tracking-wide text-[#4FC3F7]/70">Manajemen</p>
                    <a href="{{ url('/users') }}" class="{{ $navBase }} {{ request()->is('users*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Pengguna
                    </a>
                    <a href="{{ url('/pelanggan') }}" class="{{ $navBase }} {{ request()->is('pelanggan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pelanggan
                    </a>
                    <a href="{{ url('/golongan-tarif') }}" class="{{ $navBase }} {{ request()->is('golongan-tarif*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Golongan Tarif
                    </a>
                </div>

                {{-- Operasional --}}
                <div class="space-y-1">
                    <p class="px-3 mb-1 text-xs font-semibold uppercase tracking-wide text-[#4FC3F7]/70">Operasional</p>
                    <a href="{{ url('/meter') }}" class="{{ $navBase }} {{ request()->is('meter*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Pencatatan Meter
                    </a>
                    <a href="{{ url('/tagihan') }}" class="{{ $navBase }} {{ request()->is('tagihan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                        Tagihan
                    </a>
                    <a href="{{ url('/pembayaran') }}" class="{{ $navBase }} {{ request()->is('pembayaran*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pembayaran
                    </a>
                    <a href="{{ url('/pengaduan') }}" class="{{ $navBase }} {{ request()->is('pengaduan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <span class="flex-1">Pengaduan</span>
                        @if($pengaduanBaru > 0)
                            <span class="inline-flex items-center justify-center min-w-5 h-5 px-1.5 text-xs font-semibold text-white bg-red-600 rounded-full">{{ $pengaduanBaru }}</span>
                        @endif
                    </a>
                </div>

                {{-- Laporan --}}
                <div class="space-y-1">
                    <p class="px-3 mb-1 text-xs font-semibold uppercase tracking-wide text-[#4FC3F7]/70">Laporan</p>
                    <a href="{{ url('/laporan') }}" class="{{ $navBase }} {{ request()->is('laporan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan
                    </a>
                </div>
            @endif

            @if($user->isPetugas())
                <div class="space-y-1">
                    <p class="px-3 mb-1 text-xs font-semibold uppercase tracking-wide text-[#4FC3F7]/70">Operasional</p>
                    <a href="{{ url('/meter') }}" class="{{ $navBase }} {{ request()->is('meter*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Pencatatan Meter
                    </a>
                    <a href="{{ url('/tagihan') }}" class="{{ $navBase }} {{ request()->is('tagihan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                        Tagihan
                    </a>
                    <a href="{{ url('/pembayaran') }}" class="{{ $navBase }} {{ request()->is('pembayaran*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pembayaran
                    </a>
                    <!-- <a href="{{ url('/pelanggan') }}" class="{{ $navBase }} {{ request()->is('pelanggan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pelanggan
                    </a> -->
                </div>
            @endif

            @if($user->isKasir())
                <div class="space-y-1">
                    <p class="px-3 mb-1 text-xs font-semibold uppercase tracking-wide text-[#4FC3F7]/70">Operasional</p>
                    <a href="{{ url('/tagihan') }}" class="{{ $navBase }} {{ request()->is('tagihan*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                        Tagihan
                    </a>
                    <a href="{{ url('/pembayaran') }}" class="{{ $navBase }} {{ request()->is('pembayaran*') ? $navActive : $navIdle }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pembayaran
                    </a>
                </div>
            @endif
        </nav>

        {{-- User profile + logout di bawah --}}
        <div class="border-t border-white/10 p-4">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-9 h-9 rounded-full bg-[#4FC3F7] flex items-center justify-center">
                    <span class="text-sm font-semibold text-[#1A3A5C]">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-white truncate">{{ $user->name }}</p>
                    <p class="text-xs text-[#93C5FD] capitalize truncate">{{ $user->role }}</p>
                </div>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg text-[#93C5FD] hover:bg-[#2D5A8A] hover:text-white transition-colors" title="Logout" aria-label="Logout">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
