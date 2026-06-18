@extends('layouts.app')

@section('title', 'Detail Pencatatan Meter')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pencatatan Meter</h1>
                <p class="text-gray-500 mt-1">Periode: {{ $meter->periode }}</p>
            </div>
            <a href="{{ url('/meter') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pelanggan</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $meter->pelanggan->nama ?? '-' }}</p>
                <p class="text-xs text-gray-500">{{ $meter->pelanggan->no_sambungan ?? '' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Periode</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $meter->periode }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Meter Awal</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $meter->meter_awal }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Meter Akhir</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $meter->meter_akhir }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pemakaian</h3>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $meter->pemakaian }} m³</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Petugas</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $meter->petugas->name ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tanggal Pencatatan</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $meter->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Meter Photo --}}
    @if($meter->foto)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Foto Meter</h2>
            <img src="{{ asset('storage/' . $meter->foto) }}" alt="Foto meter {{ $meter->pelanggan->nama }}" class="max-w-md rounded-lg shadow-sm border border-gray-200">
        </div>
    @endif
@endsection
