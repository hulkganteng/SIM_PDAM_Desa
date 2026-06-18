@extends('layouts.portal')

@section('title', 'Tagihan Saya')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Tagihan Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Riwayat tagihan air Anda</p>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Pemakaian</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Jatuh Tempo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihan as $t)
                        <tr>
                            <td class="text-[#1A3A5C] whitespace-nowrap">{{ $t->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->pemakaian }} m³</td>
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
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->jatuh_tempo->format('d/m/Y') }}</td>
                            <td class="whitespace-nowrap">
                                <a href="{{ url('/portal/tagihan/' . $t->id) }}" class="text-[#1A3A5C] font-medium hover:underline">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Belum ada tagihan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tagihan->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $tagihan->links() }}
            </div>
        @endif
    </div>
@endsection
