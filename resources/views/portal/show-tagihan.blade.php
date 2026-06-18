@extends('layouts.portal')

@section('title', 'Detail Tagihan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="gov-page-title">Detail Tagihan</h1>
                <p class="text-sm text-gray-500 mt-1">Periode: {{ $tagihan->periode }}</p>
            </div>
            <a href="{{ url('/portal/tagihan') }}" class="gov-btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="gov-card p-6 max-w-2xl">
        {{-- Bill Status --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#E2E8F0]">
            <span class="text-sm text-gray-600">Status Pembayaran:</span>
            <span class="gov-badge {{ $tagihan->status === 'lunas' ? 'gov-badge-success' : 'gov-badge-warning' }}">
                {{ ucfirst(str_replace('_', ' ', $tagihan->status)) }}
            </span>
        </div>

        {{-- Bill Breakdown --}}
        <div class="bg-[#F8FAFC] rounded-xl p-4 mb-6 border border-[#E2E8F0]">
            <table class="w-full text-sm">
                <tbody>
                    <tr class="border-b border-[#E2E8F0]">
                        <td class="py-2 text-gray-600">Pemakaian Air</td>
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
                    <tr class="font-semibold text-lg">
                        <td class="py-3 text-[#1A3A5C]">Total Tagihan</td>
                        <td class="py-3 text-right text-[#1A3A5C]">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Due Date --}}
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Jatuh Tempo:</span>
            <span class="text-sm font-medium {{ $tagihan->status === 'belum_bayar' && $tagihan->jatuh_tempo->isPast() ? 'text-red-600' : 'text-[#1A3A5C]' }}">
                {{ $tagihan->jatuh_tempo->format('d/m/Y') }}
                @if($tagihan->status === 'belum_bayar' && $tagihan->jatuh_tempo->isPast())
                    <span class="text-xs text-red-500">(Terlambat)</span>
                @endif
            </span>
        </div>
    </div>
@endsection
