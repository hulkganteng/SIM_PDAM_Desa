@extends('layouts.app')

@section('title', 'Detail Pencatatan Meter')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="gov-page-title">Detail Pencatatan Meter</h1>
                <p class="text-sm text-gray-500 mt-1">Periode: {{ $meter->periode }}</p>
            </div>
            <a href="{{ url('/meter') }}" class="gov-btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="gov-card p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pelanggan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $meter->pelanggan->nama ?? '-' }}</p>
                <p class="text-xs text-gray-500">{{ $meter->pelanggan->no_sambungan ?? '' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Periode</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $meter->periode }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Meter Awal</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $meter->meter_awal }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Meter Akhir</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $meter->meter_akhir }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pemakaian</h3>
                <p class="mt-1 text-sm font-semibold text-[#1A3A5C]">{{ $meter->pemakaian }} m³</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Petugas</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $meter->petugas->name ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tanggal Pencatatan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $meter->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Meter Photo --}}
    @if($meter->foto)
        <div class="gov-card p-6">
            <h2 class="gov-section-title mb-4">Foto Meter</h2>
            <img src="{{ asset('storage/' . $meter->foto) }}" alt="Foto meter {{ $meter->pelanggan->nama }}" class="max-w-md rounded-xl border border-[#E2E8F0]">
        </div>
    @endif
@endsection
