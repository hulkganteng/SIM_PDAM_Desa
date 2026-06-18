@extends('layouts.app')

@section('title', 'Laporan Pelanggan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="gov-page-title">Laporan Pelanggan</h1>
            <p class="text-sm text-gray-500 mt-1">Data pelanggan lengkap</p>
        </div>
        <a href="{{ url('/laporan') }}" class="gov-btn-secondary">Kembali</a>
    </div>

    {{-- Export Buttons --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ url('/laporan/export/pelanggan/pdf') }}" class="gov-btn-danger">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export PDF
        </a>
        <a href="{{ url('/laporan/export/pelanggan/excel') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
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
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Golongan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggan as $p)
                        <tr>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $p->no_sambungan }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->nama }}</td>
                            <td class="text-gray-600 max-w-xs truncate">{{ $p->alamat }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->no_hp }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Belum ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($pelanggan, 'hasPages') && $pelanggan->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $pelanggan->links() }}
            </div>
        @endif
    </div>
@endsection
