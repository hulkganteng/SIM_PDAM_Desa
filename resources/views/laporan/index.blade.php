@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Laporan</h1>
        <p class="text-sm text-gray-500 mt-1">Pilih jenis laporan yang ingin ditampilkan</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Laporan Tagihan --}}
        <a href="{{ url('/laporan/tagihan') }}" class="gov-card p-6 hover:border-[#4FC3F7] transition-colors group">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-base font-semibold text-[#1A3A5C]">Laporan Tagihan</h3>
            <p class="text-sm text-gray-500 mt-1">Rekap tagihan per periode dengan detail pemakaian dan status pembayaran</p>
        </a>

        {{-- Laporan Pembayaran --}}
        <a href="{{ url('/laporan/pembayaran') }}" class="gov-card p-6 hover:border-[#4FC3F7] transition-colors group">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-base font-semibold text-[#1A3A5C]">Laporan Pembayaran</h3>
            <p class="text-sm text-gray-500 mt-1">Rekap pendapatan dari pembayaran tagihan berdasarkan rentang tanggal</p>
        </a>

        {{-- Laporan Pelanggan --}}
        <a href="{{ url('/laporan/pelanggan') }}" class="gov-card p-6 hover:border-[#4FC3F7] transition-colors group">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-base font-semibold text-[#1A3A5C]">Laporan Pelanggan</h3>
            <p class="text-sm text-gray-500 mt-1">Data pelanggan lengkap dengan golongan tarif dan status sambungan</p>
        </a>
    </div>
@endsection
