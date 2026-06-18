@extends('layouts.portal')

@section('title', 'Detail Tagihan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Tagihan</h1>
                <p class="text-gray-500 mt-1">Periode: {{ $tagihan->periode }}</p>
            </div>
            <a href="{{ url('/portal/tagihan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        {{-- Bill Status --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
            <span class="text-sm text-gray-600">Status Pembayaran:</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $tagihan->status === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ucfirst(str_replace('_', ' ', $tagihan->status)) }}
            </span>
        </div>

        {{-- Bill Breakdown --}}
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <table class="w-full text-sm">
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-600">Pemakaian Air</td>
                        <td class="py-2 text-right text-gray-900">{{ $tagihan->pemakaian }} m³</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-600">Tarif per m³</td>
                        <td class="py-2 text-right text-gray-900">Rp {{ number_format($tagihan->tarif_per_m3, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-600">Biaya Pemakaian ({{ $tagihan->pemakaian }} × Rp {{ number_format($tagihan->tarif_per_m3, 0, ',', '.') }})</td>
                        <td class="py-2 text-right text-gray-900">Rp {{ number_format($tagihan->pemakaian * $tagihan->tarif_per_m3, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-600">Biaya Beban</td>
                        <td class="py-2 text-right text-gray-900">Rp {{ number_format($tagihan->biaya_beban, 0, ',', '.') }}</td>
                    </tr>
                    @if($tagihan->denda > 0)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 text-red-600">Denda Keterlambatan</td>
                            <td class="py-2 text-right text-red-600">Rp {{ number_format($tagihan->denda, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    <tr class="font-bold text-lg">
                        <td class="py-3 text-gray-900">Total Tagihan</td>
                        <td class="py-3 text-right text-gray-900">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Due Date --}}
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">Jatuh Tempo:</span>
            <span class="text-sm font-medium {{ $tagihan->status === 'belum_bayar' && $tagihan->jatuh_tempo->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                {{ $tagihan->jatuh_tempo->format('d/m/Y') }}
                @if($tagihan->status === 'belum_bayar' && $tagihan->jatuh_tempo->isPast())
                    <span class="text-xs text-red-500">(Terlambat)</span>
                @endif
            </span>
        </div>
    </div>
@endsection
