@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="gov-page-title">Detail Pelanggan</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $pelanggan->no_sambungan }}</p>
            </div>
            <a href="{{ url('/pelanggan') }}" class="gov-btn-secondary">Kembali</a>
        </div>
    </div>

    {{-- Customer Detail Card --}}
    <div class="gov-card p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pelanggan->nama }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. Sambungan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pelanggan->no_sambungan }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pelanggan->alamat }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. HP</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pelanggan->no_hp }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Golongan Tarif</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pelanggan->golonganTarif->nama ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Status</h3>
                <span class="gov-badge mt-1
                    @if($pelanggan->status === 'aktif') gov-badge-success
                    @elseif($pelanggan->status === 'nonaktif') gov-badge-warning
                    @else gov-badge-danger
                    @endif">
                    {{ ucfirst($pelanggan->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Billing History --}}
    <div class="gov-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-[#E2E8F0]">
            <h2 class="gov-section-title">Riwayat Tagihan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Pemakaian</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan->tagihans()->latest()->take(10)->get() as $tagihan)
                        <tr>
                            <td class="text-[#1A3A5C] whitespace-nowrap">{{ $tagihan->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $tagihan->pemakaian }} m³</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge {{ $tagihan->status === 'lunas' ? 'gov-badge-success' : 'gov-badge-danger' }}">
                                    {{ ucfirst(str_replace('_', ' ', $tagihan->status)) }}
                                </span>
                            </td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $tagihan->jatuh_tempo->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Belum ada riwayat tagihan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Meter Reading History --}}
    <div class="gov-card overflow-hidden">
        <div class="px-6 py-4 border-b border-[#E2E8F0]">
            <h2 class="gov-section-title">Riwayat Pencatatan Meter</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        <th>Pemakaian</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan->pencatatanMeters()->latest()->take(10)->get() as $meter)
                        <tr>
                            <td class="text-[#1A3A5C] whitespace-nowrap">{{ $meter->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->meter_awal }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->meter_akhir }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->pemakaian }} m³</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->petugas->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Belum ada riwayat pencatatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
