@extends('layouts.app')

@section('title', 'Detail Tagihan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="gov-page-title">Detail Tagihan</h1>
                <p class="text-sm text-gray-500 mt-1">Periode: {{ $tagihan->periode }}</p>
            </div>
            <a href="{{ url('/tagihan') }}" class="gov-btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="gov-card p-6 max-w-3xl">
        {{-- Customer Info --}}
        <div class="mb-6 pb-6 border-b border-[#E2E8F0]">
            <h2 class="gov-section-title mb-3">Informasi Pelanggan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <span class="text-sm text-gray-500">Nama:</span>
                    <p class="text-sm font-medium text-[#1A3A5C]">{{ $tagihan->pelanggan->nama ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">No. Sambungan:</span>
                    <p class="text-sm font-medium text-[#1A3A5C]">{{ $tagihan->pelanggan->no_sambungan ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Bill Breakdown --}}
        <div class="mb-6">
            <h2 class="gov-section-title mb-3">Rincian Tagihan</h2>
            <div class="bg-[#F8FAFC] rounded-xl p-4 border border-[#E2E8F0]">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-[#E2E8F0]">
                            <td class="py-2 text-gray-600">Pemakaian</td>
                            <td class="py-2 text-right text-[#1A3A5C]">{{ $tagihan->pemakaian }} m³</td>
                        </tr>
                        <tr class="border-b border-[#E2E8F0]">
                            <td class="py-2 text-gray-600">Tarif per m³</td>
                            <td class="py-2 text-right text-[#1A3A5C]">Rp {{ number_format($tagihan->tarif_per_m3, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-b border-[#E2E8F0]">
                            <td class="py-2 text-gray-600">Biaya Pemakaian ({{ $tagihan->pemakaian }} × Rp {{ number_format($tagihan->tarif_per_m3, 0, ',', '.') }})</td>
                            <td class="py-2 text-right text-[#1A3A5C]">Rp {{ number_format($tagihan->pemakaian * $tagihan->tarif_per_m3, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-b border-[#E2E8F0]">
                            <td class="py-2 text-gray-600">Biaya Beban</td>
                            <td class="py-2 text-right text-[#1A3A5C]">Rp {{ number_format($tagihan->biaya_beban, 0, ',', '.') }}</td>
                        </tr>
                        @if($tagihan->denda > 0)
                            <tr class="border-b border-[#E2E8F0]">
                                <td class="py-2 text-red-600">Denda Keterlambatan</td>
                                <td class="py-2 text-right text-red-600">Rp {{ number_format($tagihan->denda, 0, ',', '.') }}</td>
                            </tr>
                        @endif
                        <tr class="font-semibold">
                            <td class="py-3 text-[#1A3A5C]">Total</td>
                            <td class="py-3 text-right text-[#1A3A5C] text-lg">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Status & Due Date --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <span class="text-sm text-gray-500">Status:</span>
                <span class="gov-badge ml-2 {{ $tagihan->status === 'lunas' ? 'gov-badge-success' : 'gov-badge-warning' }}">
                    {{ ucfirst(str_replace('_', ' ', $tagihan->status)) }}
                </span>
            </div>
            <div>
                <span class="text-sm text-gray-500">Jatuh Tempo:</span>
                <p class="text-sm font-medium text-[#1A3A5C]">{{ $tagihan->jatuh_tempo->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
@endsection
