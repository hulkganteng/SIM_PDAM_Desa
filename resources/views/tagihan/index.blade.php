@extends('layouts.app')

@section('title', 'Tagihan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Data Tagihan</h1>
        @if(auth()->user()->role === 'admin')
            <a href="{{ url('/tagihan/generate') }}" class="gov-btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Generate Tagihan
            </a>
        @endif
    </div>

    {{-- Filters --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/tagihan') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no sambungan / nama..." class="gov-input">
            </div>
            <div class="sm:w-44">
                <select name="status" class="gov-input">
                    <option value="">Semua Status</option>
                    <option value="belum_bayar" {{ request('status') === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="lunas" {{ request('status') === 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>
            <div class="sm:w-44">
                <input type="month" name="periode" value="{{ request('periode') }}" class="gov-input">
            </div>
            <button type="submit" class="gov-btn-primary">Filter</button>
        </form>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Periode</th>
                        <th>Pemakaian</th>
                        <th>Total</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihan as $t)
                        <tr class="cursor-pointer" onclick="window.location='{{ url('/tagihan/' . $t->id) }}'">
                            <td class="whitespace-nowrap">
                                <span class="text-[#1A3A5C] font-medium">{{ $t->pelanggan->nama ?? '-' }}</span>
                                <span class="block text-xs text-gray-500">{{ $t->pelanggan->no_sambungan ?? '' }}</span>
                            </td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->pemakaian }} m³</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap">
                                @if($t->denda > 0)
                                    <span class="text-red-600">Rp {{ number_format($t->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap">
                                @php
                                    $tagihanBadge = match($t->status) {
                                        'lunas' => 'gov-badge-success',
                                        'belum_bayar' => 'gov-badge-warning',
                                        default => 'gov-badge-danger',
                                    };
                                @endphp
                                <span class="gov-badge {{ $tagihanBadge }}">
                                    {{ ucfirst(str_replace('_', ' ', $t->status)) }}
                                </span>
                            </td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $t->jatuh_tempo->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">Belum ada data tagihan.</td>
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
