@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="gov-page-title">Laporan Pembayaran</h1>
            <p class="text-sm text-gray-500 mt-1">Rekap pendapatan dari pembayaran tagihan</p>
        </div>
        <a href="{{ url('/laporan') }}" class="gov-btn-secondary">Kembali</a>
    </div>

    {{-- Filter --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/laporan/pembayaran') }}" class="flex flex-col sm:flex-row gap-3 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}" class="gov-input">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" class="gov-input">
            </div>
            <button type="submit" class="gov-btn-primary">Tampilkan</button>
        </form>
    </div>

    {{-- Export Buttons --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ url('/laporan/export/pembayaran/pdf?start_date=' . request('start_date', now()->startOfMonth()->format('Y-m-d')) . '&end_date=' . request('end_date', now()->format('Y-m-d'))) }}" class="gov-btn-danger">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export PDF
        </a>
        <a href="{{ url('/laporan/export/pembayaran/excel?start_date=' . request('start_date', now()->startOfMonth()->format('Y-m-d')) . '&end_date=' . request('end_date', now()->format('Y-m-d'))) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export Excel
        </a>
    </div>

    {{-- Report Table --}}
    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>No Kuitansi</th>
                        <th>Pelanggan</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                        <tr>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td class="font-mono text-[#1A3A5C] whitespace-nowrap">{{ $p->no_kuitansi }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tagihan->pelanggan->nama ?? '-' }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td class="text-gray-600 capitalize whitespace-nowrap">{{ $p->metode }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Tidak ada data pembayaran untuk rentang tanggal ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if(isset($pembayaran) && $pembayaran->count() > 0)
                    <tfoot class="bg-[#F8FAFC]">
                        <tr>
                            <td colspan="3" class="px-5 py-3 text-sm font-semibold text-[#1A3A5C]">Total</td>
                            <td class="px-5 py-3 text-sm font-semibold text-[#1A3A5C]">Rp {{ number_format($pembayaran->sum('jumlah'), 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
        @if(method_exists($pembayaran, 'hasPages') && $pembayaran->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $pembayaran->links() }}
            </div>
        @endif
    </div>
@endsection
