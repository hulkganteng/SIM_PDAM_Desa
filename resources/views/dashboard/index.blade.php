@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 mt-1">Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card title="Pelanggan Aktif" :value="$pelangganAktif" color="indigo">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </x-slot>
        </x-stat-card>

        <x-stat-card title="Pendapatan Bulan Ini" :value="'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.')" color="green">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </x-slot>
        </x-stat-card>

        <x-stat-card title="Tagihan Belum Bayar" :value="$tagihanBelumBayar" color="red">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
            </x-slot>
        </x-stat-card>

        <x-stat-card title="Pengaduan Terbuka" :value="$pengaduanTerbuka" color="yellow">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </x-slot>
        </x-stat-card>
    </div>

    {{-- Meter Reading Progress --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Progress Pencatatan Meter Bulan Ini</h2>
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">{{ $meterCompleted }} dari {{ $meterTotal }} pelanggan tercatat</span>
            <span class="text-sm font-medium text-indigo-600">{{ $meterTotal > 0 ? round(($meterCompleted / $meterTotal) * 100) : 0 }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-indigo-600 h-3 rounded-full transition-all duration-500" style="width: {{ $meterTotal > 0 ? ($meterCompleted / $meterTotal) * 100 : 0 }}%"></div>
        </div>
    </div>
@endsection
