@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Pembayaran</h1>
            <p class="text-gray-500 mt-1">Rekap pendapatan dari pembayaran tagihan</p>
        </div>
        <a href="{{ url('/laporan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
            Kembali
        </a>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="{{ url('/laporan/pembayaran') }}" class="flex flex-col sm:flex-row gap-3 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                Tampilkan
            </button>
        </form>
    </div>

    {{-- Export Buttons --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ url('/laporan/export/pembayaran/pdf?start_date=' . request('start_date', now()->startOfMonth()->format('Y-m-d')) . '&end_date=' . request('end_date', now()->format('Y-m-d'))) }}" class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export PDF
        </a>
        <a href="{{ url('/laporan/export/pembayaran/excel?start_date=' . request('start_date', now()->startOfMonth()->format('Y-m-d')) . '&end_date=' . request('end_date', now()->format('Y-m-d'))) }}" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export Excel
        </a>
    </div>

    {{-- Report Table --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kuitansi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pembayaran as $p)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $p->no_kuitansi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $p->tagihan->pelanggan->nama ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 capitalize">{{ $p->metode }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pembayaran untuk rentang tanggal ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if(isset($pembayaran) && $pembayaran->count() > 0)
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-sm font-semibold text-gray-900">Total</td>
                            <td class="px-6 py-3 text-sm font-bold text-gray-900">Rp {{ number_format($pembayaran->sum('jumlah'), 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
        @if(method_exists($pembayaran, 'hasPages') && $pembayaran->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $pembayaran->links() }}
            </div>
        @endif
    </div>
@endsection
