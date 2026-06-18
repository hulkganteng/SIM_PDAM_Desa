@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Data Pengaduan</h1>
    </div>

    {{-- Status Filter --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/pengaduan') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="sm:w-48">
                <select name="status" class="gov-input">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
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
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $p)
                        <tr>
                            <td class="text-[#1A3A5C] font-medium whitespace-nowrap">{{ $p->pelanggan->nama ?? '-' }}</td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge bg-[#DCE6F0] text-[#1A3A5C] capitalize">{{ str_replace('_', ' ', $p->kategori) }}</span>
                            </td>
                            <td class="text-gray-600 max-w-xs truncate">{{ Str::limit($p->deskripsi, 50) }}</td>
                            <td class="whitespace-nowrap">
                                @php
                                    $pengaduanBadge = match($p->status) {
                                        'selesai' => 'gov-badge-success',
                                        'diproses' => 'gov-badge-info',
                                        default => 'gov-badge-danger',
                                    };
                                @endphp
                                <span class="gov-badge {{ $pengaduanBadge }}">{{ ucfirst($p->status) }}</span>
                            </td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td class="whitespace-nowrap">
                                <a href="{{ url('/pengaduan/' . $p->id) }}" class="text-[#1A3A5C] font-medium hover:underline">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Belum ada data pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengaduan->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $pengaduan->links() }}
            </div>
        @endif
    </div>
@endsection
