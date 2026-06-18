@extends('layouts.portal')

@section('title', 'Profil Saya')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Informasi akun dan data pelanggan Anda</p>
    </div>

    <div class="gov-card p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pelanggan->nama }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. Sambungan</h3>
                <p class="mt-1 text-sm font-mono font-medium text-[#1A3A5C]">{{ $pelanggan->no_sambungan }}</p>
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
                <h3 class="text-sm font-medium text-gray-500">Status Sambungan</h3>
                <span class="gov-badge mt-1
                    @if($pelanggan->status === 'aktif') gov-badge-success
                    @elseif($pelanggan->status === 'nonaktif') gov-badge-warning
                    @else gov-badge-danger
                    @endif">
                    {{ ucfirst($pelanggan->status) }}
                </span>
            </div>
        </div>

        {{-- Tariff Info --}}
        @if($pelanggan->golonganTarif)
            <div class="mt-6 pt-6 border-t border-[#E2E8F0]">
                <h3 class="gov-section-title mb-3">Informasi Tarif</h3>
                <div class="bg-[#F8FAFC] rounded-xl p-4 border border-[#E2E8F0]">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Tarif per m³:</span>
                            <p class="font-medium text-[#1A3A5C]">Rp {{ number_format($pelanggan->golonganTarif->tarif_per_m3, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Biaya Beban:</span>
                            <p class="font-medium text-[#1A3A5C]">Rp {{ number_format($pelanggan->golonganTarif->biaya_beban, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Denda Keterlambatan:</span>
                            <p class="font-medium text-[#1A3A5C]">Rp {{ number_format($pelanggan->golonganTarif->denda, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
