@extends('layouts.app')

@section('title', 'Proses Pembayaran')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Proses Pembayaran</h1>
        <p class="text-gray-500 mt-1">Cari tagihan dan proses pembayaran</p>
    </div>

    {{-- Search Bill --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Cari Tagihan</h2>
        <form method="GET" action="{{ url('/pembayaran/create') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no sambungan atau nama pelanggan..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                Cari
            </button>
        </form>
    </div>

    {{-- Search Results / Selected Tagihan --}}
    @if(isset($tagihanList) && $tagihanList->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Tagihan Belum Bayar</h2>
            <div class="space-y-3">
                @foreach($tagihanList as $t)
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-900">{{ $t->pelanggan->nama ?? '-' }} <span class="text-gray-500 text-sm">({{ $t->pelanggan->no_sambungan ?? '' }})</span></p>
                                <p class="text-sm text-gray-600">Periode: {{ $t->periode }} | Pemakaian: {{ $t->pemakaian }} m³</p>
                                <p class="text-sm font-semibold text-gray-900 mt-1">Total: Rp {{ number_format($t->total, 0, ',', '.') }}</p>
                            </div>
                            <form method="POST" action="{{ url('/pembayaran') }}">
                                @csrf
                                <input type="hidden" name="tagihan_id" value="{{ $t->id }}">
                                <div class="flex items-center gap-2">
                                    <select name="metode" required class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="qris">QRIS</option>
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition-colors" onclick="return confirm('Proses pembayaran Rp {{ number_format($t->total, 0, ',', '.') }}?')">
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
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <p class="text-center text-gray-500">Tidak ditemukan tagihan belum bayar untuk pencarian "{{ request('search') }}".</p>
        </div>
    @endif
@endsection
