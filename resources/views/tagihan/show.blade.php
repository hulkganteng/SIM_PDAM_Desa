@extends('layouts.app')

@section('title', 'Detail Tagihan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Tagihan</h1>
                <p class="text-gray-500 mt-1">Periode: {{ $tagihan->periode }}</p>
            </div>
            <a href="{{ url('/tagihan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        {{-- Customer Info --}}
        <div class="mb-6 pb-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pelanggan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <span class="text-sm text-gray-500">Nama:</span>
                    <p class="text-sm font-medium text-gray-900">{{ $tagihan->pelanggan->nama ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">No. Sambungan:</span>
                    <p class="text-sm font-medium text-gray-900">{{ $tagihan->pelanggan->no_sambungan ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Bill Breakdown --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Rincian Tagihan</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-200">
                            <td class="py-2 text-gray-600">Pemakaian</td>
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
                        <tr class="font-bold">
                            <td class="py-3 text-gray-900">Total</td>
                            <td class="py-3 text-right text-gray-900 text-lg">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Status & Due Date --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <span class="text-sm text-gray-500">Status:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ml-2 {{ $tagihan->status === 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst(str_replace('_', ' ', $tagihan->status)) }}
                </span>
            </div>
            <div>
                <span class="text-sm text-gray-500">Jatuh Tempo:</span>
                <p class="text-sm font-medium text-gray-900">{{ $tagihan->jatuh_tempo->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
@endsection
