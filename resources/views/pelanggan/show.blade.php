@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pelanggan</h1>
                <p class="text-gray-500 mt-1">{{ $pelanggan->no_sambungan }}</p>
            </div>
            <a href="{{ url('/pelanggan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                Kembali
            </a>
        </div>
    </div>

    {{-- Customer Detail Card --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pelanggan->nama }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. Sambungan</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pelanggan->no_sambungan }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pelanggan->alamat }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. HP</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pelanggan->no_hp }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Golongan Tarif</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pelanggan->golonganTarif->nama ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Status</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                    @if($pelanggan->status === 'aktif') bg-green-100 text-green-800
                    @elseif($pelanggan->status === 'nonaktif') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($pelanggan->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Billing History --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Tagihan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemakaian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pelanggan->tagihans()->latest()->take(10)->get() as $tagihan)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tagihan->periode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $tagihan->pemakaian }} m³</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $tagihan->status === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $tagihan->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $tagihan->jatuh_tempo->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat tagihan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Meter Reading History --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Pencatatan Meter</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meter Awal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meter Akhir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemakaian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pelanggan->pencatatanMeters()->latest()->take(10)->get() as $meter)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $meter->periode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->meter_awal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->meter_akhir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->pemakaian }} m³</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->petugas->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat pencatatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
