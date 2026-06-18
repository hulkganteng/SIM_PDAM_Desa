@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="gov-page-title">Detail Pembayaran</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $pembayaran->no_kuitansi }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ url('/pembayaran/' . $pembayaran->id . '/receipt') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Kuitansi
                </a>
                <a href="{{ url('/pembayaran') }}" class="gov-btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <div class="gov-card p-6 max-w-3xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">No. Kuitansi</h3>
                <p class="mt-1 text-sm font-mono font-medium text-[#1A3A5C]">{{ $pembayaran->no_kuitansi }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tanggal Pembayaran</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pembayaran->tanggal->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pelanggan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pembayaran->tagihan->pelanggan->nama ?? '-' }}</p>
                <p class="text-xs text-gray-500">{{ $pembayaran->tagihan->pelanggan->no_sambungan ?? '' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Periode Tagihan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pembayaran->tagihan->periode ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Jumlah Bayar</h3>
                <p class="mt-1 text-lg font-semibold text-[#1A3A5C]">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Metode Pembayaran</h3>
                <span class="gov-badge gov-badge-info capitalize mt-1">{{ $pembayaran->metode }}</span>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Kasir</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pembayaran->kasir->name ?? '-' }}</p>
            </div>
        </div>
    </div>
@endsection
