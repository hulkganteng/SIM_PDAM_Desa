@extends('layouts.app')

@section('title', 'Laporan Tagihan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="gov-page-title">Laporan Tagihan</h1>
            <p class="text-sm text-gray-500 mt-1">Rekap tagihan per periode</p>
        </div>
        <a href="{{ url('/laporan') }}" class="gov-btn-secondary">Kembali</a>
    </div>

    {{-- Filter --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/laporan/tagihan') }}" class="flex flex-col sm:flex-row gap-3 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Periode</label>
                <input type="month" name="periode" value="{{ request('periode', date('Y-m')) }}" class="gov-input">
            </div>
            <button type="submit" class="gov-btn-primary">Tampilkan</button>
        </form>
    </div>

    {{-- Export Buttons --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ url('/laporan/export/tagihan/pdf?periode=' . request('periode', date('Y-m'))) }}" class="gov-btn-danger">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export PDF
        </a>
        <a href="{{ url('/laporan/export/tagihan/excel?periode=' . request('periode', date('Y-m'))) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
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
                        <th>No Sambungan</th>
                        <th>Nama</th>
                        <th>Pemakaian (m³)</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihan as $t)
                        <tr>
                            <td class="text-[#1A3A5C] whitespace-nowrap">{{ $t->pelanggan->no_sambungan ?? '-' }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->pelanggan->nama ?? '-' }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->pemakaian }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap">
                                @php
                                    $tagihanBadge = match($t->status) {
                                        'lunas' => 'gov-badge-success',
                                        'belum_bayar' => 'gov-badge-warning',
                                        default => 'gov-badge-danger',
                                    };
                                @endphp
                                <span class="gov-badge {{ $tagihanBadge }}">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Tidak ada data tagihan untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($tagihan, 'hasPages') && $tagihan->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $tagihan->links() }}
            </div>
        @endif
    </div>
@endsection
