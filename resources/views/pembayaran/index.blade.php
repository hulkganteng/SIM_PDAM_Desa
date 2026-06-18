@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Data Pembayaran</h1>
        <a href="{{ url('/pembayaran/create') }}" class="gov-btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Proses Pembayaran
        </a>
    </div>

    {{-- Date Range Filter --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/pembayaran') }}" class="flex flex-col sm:flex-row gap-3">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="gov-input">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="gov-input">
            </div>
            <div class="flex items-end">
                <button type="submit" class="gov-btn-primary">Filter</button>
            </div>
        </form>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>No Kuitansi</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                        <tr>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tanggal->format('d/m/Y H:i') }}</td>
                            <td class="whitespace-nowrap">
                                <span class="text-[#1A3A5C] font-medium">{{ $p->tagihan->pelanggan->nama ?? '-' }}</span>
                                <span class="block text-xs text-gray-500">{{ $p->tagihan->pelanggan->no_sambungan ?? '' }}</span>
                            </td>
                            <td class="font-mono text-gray-600 whitespace-nowrap">{{ $p->no_kuitansi }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge gov-badge-info capitalize">{{ $p->metode }}</span>
                            </td>
                            <td class="whitespace-nowrap space-x-3">
                                <a href="{{ url('/pembayaran/' . $p->id) }}" class="text-[#1A3A5C] font-medium hover:underline">Detail</a>
                                <a href="{{ url('/pembayaran/' . $p->id . '/receipt') }}" class="text-emerald-600 font-medium hover:underline">Cetak</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Belum ada data pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pembayaran->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $pembayaran->links() }}
            </div>
        @endif
    </div>
@endsection
