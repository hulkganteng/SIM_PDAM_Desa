@extends('layouts.portal')

@section('title', 'Profil Saya')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil Saya</h1>
        <p class="text-gray-500 mt-1">Informasi akun dan data pelanggan Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pelanggan->nama }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. Sambungan</h3>
                <p class="mt-1 text-sm font-mono font-medium text-gray-900">{{ $pelanggan->no_sambungan }}</p>
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
                <h3 class="text-sm font-medium text-gray-500">Status Sambungan</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                    @if($pelanggan->status === 'aktif') bg-green-100 text-green-800
                    @elseif($pelanggan->status === 'nonaktif') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($pelanggan->status) }}
                </span>
            </div>
        </div>

        {{-- Tariff Info --}}
        @if($pelanggan->golonganTarif)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-medium text-gray-800 mb-3">Informasi Tarif</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Tarif per m³:</span>
                            <p class="font-medium text-gray-900">Rp {{ number_format($pelanggan->golonganTarif->tarif_per_m3, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Biaya Beban:</span>
                            <p class="font-medium text-gray-900">Rp {{ number_format($pelanggan->golonganTarif->biaya_beban, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Denda Keterlambatan:</span>
                            <p class="font-medium text-gray-900">Rp {{ number_format($pelanggan->golonganTarif->denda, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
