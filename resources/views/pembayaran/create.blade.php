@extends('layouts.app')

@section('title', 'Proses Pembayaran')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Proses Pembayaran</h1>
        <p class="text-sm text-gray-500 mt-1">Cari tagihan dan proses pembayaran</p>
    </div>

    {{-- Search Bill --}}
    <div class="gov-card p-6 mb-6">
        <h2 class="gov-section-title mb-4">Cari Tagihan</h2>
        <form method="GET" action="{{ url('/pembayaran/create') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no sambungan atau nama pelanggan..." class="gov-input">
            </div>
            <button type="submit" class="gov-btn-primary">Cari</button>
        </form>
    </div>

    {{-- Search Results / Selected Tagihan --}}
    @if(isset($tagihanList) && $tagihanList->count() > 0)
        <div class="gov-card p-6 mb-6">
            <h2 class="gov-section-title mb-4">Tagihan Belum Bayar</h2>
            <div class="space-y-3">
                @foreach($tagihanList as $t)
                    <div class="border border-[#E2E8F0] rounded-xl p-4 hover:bg-[#F8FAFC] transition-colors">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                            <div>
                                <p class="font-medium text-[#1A3A5C]">{{ $t->pelanggan->nama ?? '-' }} <span class="text-gray-500 text-sm">({{ $t->pelanggan->no_sambungan ?? '' }})</span></p>
                                <p class="text-sm text-gray-600">Periode: {{ $t->periode }} | Pemakaian: {{ $t->pemakaian }} m³</p>
                                <p class="text-sm font-semibold text-[#1A3A5C] mt-1">Total: Rp {{ number_format($t->total, 0, ',', '.') }}</p>
                            </div>
                            <form method="POST" action="{{ url('/pembayaran') }}">
                                @csrf
                                <input type="hidden" name="tagihan_id" value="{{ $t->id }}">
                                <div class="flex items-center gap-2">
                                    <select name="metode" required class="gov-input w-auto">
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="qris">QRIS</option>
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors" onclick="return confirm('Proses pembayaran Rp {{ number_format($t->total, 0, ',', '.') }}?')">
                                        Bayar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif(request('search'))
        <div class="gov-card p-6">
            <p class="text-center text-gray-500">Tidak ditemukan tagihan belum bayar untuk pencarian "{{ request('search') }}".</p>
        </div>
    @endif
@endsection
