@extends('layouts.portal')

@section('title', 'Riwayat Pembayaran')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Riwayat Pembayaran</h1>
        <p class="text-sm text-gray-500 mt-1">Histori pembayaran tagihan air Anda</p>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>No Kuitansi</th>
                        <th>Periode</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                        <tr>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td class="font-mono text-[#1A3A5C] whitespace-nowrap">{{ $p->no_kuitansi }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tagihan->periode ?? '-' }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge gov-badge-info capitalize">{{ $p->metode }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Belum ada riwayat pembayaran.</td>
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
