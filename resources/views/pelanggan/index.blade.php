@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Data Pelanggan</h1>
        @if(auth()->user()->role === 'admin')
            <a href="{{ url('/pelanggan/create') }}" class="gov-btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pelanggan
            </a>
        @endif
    </div>

    {{-- Filters --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/pelanggan') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau no sambungan..." class="gov-input">
            </div>
            <div class="sm:w-48">
                <select name="status" class="gov-input">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="diputus" {{ request('status') === 'diputus' ? 'selected' : '' }}>Diputus</option>
                </select>
            </div>
            <button type="submit" class="gov-btn-primary">Cari</button>
        </form>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>No Sambungan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Golongan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan as $p)
                        <tr>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $p->no_sambungan }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->nama }}</td>
                            <td class="text-gray-600 max-w-xs truncate">{{ $p->alamat }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->golonganTarif->nama ?? '-' }}</td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge
                                    @if($p->status === 'aktif') gov-badge-success
                                    @elseif($p->status === 'nonaktif') gov-badge-warning
                                    @else gov-badge-danger
                                    @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap space-x-3">
                                <a href="{{ url('/pelanggan/' . $p->id) }}" class="text-[#1A3A5C] font-medium hover:underline">Detail</a>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ url('/pelanggan/' . $p->id . '/edit') }}" class="text-[#1A3A5C] font-medium hover:underline">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Belum ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pelanggan->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $pelanggan->links() }}
            </div>
        @endif
    </div>
@endsection
