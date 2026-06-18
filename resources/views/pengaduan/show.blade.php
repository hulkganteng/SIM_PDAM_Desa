@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="gov-page-title">Detail Pengaduan</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $pengaduan->pelanggan->nama ?? '-' }} - {{ $pengaduan->tanggal->format('d/m/Y') }}</p>
            </div>
            <a href="{{ url('/pengaduan') }}" class="gov-btn-secondary">Kembali</a>
        </div>
    </div>

    {{-- Complaint Detail --}}
    <div class="gov-card p-6 mb-6 max-w-3xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pelanggan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pengaduan->pelanggan->nama ?? '-' }}</p>
                <p class="text-xs text-gray-500">{{ $pengaduan->pelanggan->no_sambungan ?? '' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
                <span class="gov-badge bg-[#DCE6F0] text-[#1A3A5C] capitalize mt-1">{{ str_replace('_', ' ', $pengaduan->kategori) }}</span>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tanggal Pengaduan</h3>
                <p class="mt-1 text-sm text-[#1A3A5C]">{{ $pengaduan->tanggal->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Status</h3>
                @php
                    $pengaduanBadge = match($pengaduan->status) {
                        'selesai' => 'gov-badge-success',
                        'diproses' => 'gov-badge-info',
                        default => 'gov-badge-danger',
                    };
                @endphp
                <span class="gov-badge {{ $pengaduanBadge }} mt-1">{{ ucfirst($pengaduan->status) }}</span>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi</h3>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-sm text-[#1A3A5C] border border-[#E2E8F0]">
                {{ $pengaduan->deskripsi }}
            </div>
        </div>

        @if($pengaduan->catatan_admin)
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Catatan Admin</h3>
                <div class="bg-blue-50 rounded-xl p-4 text-sm text-[#1A3A5C] border border-blue-200">
                    {{ $pengaduan->catatan_admin }}
                </div>
            </div>
        @endif
    </div>

    {{-- Status Update Form --}}
    @if($pengaduan->status !== 'selesai')
        <div class="gov-card p-6 max-w-3xl">
            <h2 class="gov-section-title mb-4">Update Status</h2>
            <form method="POST" action="{{ url('/pengaduan/' . $pengaduan->id) }}">
                @csrf
                @method('PUT')

                <x-form-group label="Status" name="status" type="select" :required="true">
                    @if($pengaduan->status === 'baru')
                        <option value="diproses">Diproses</option>
                    @elseif($pengaduan->status === 'diproses')
                        <option value="selesai">Selesai</option>
                    @endif
                </x-form-group>

                <x-form-group label="Catatan Admin" name="catatan_admin" type="textarea" :value="$pengaduan->catatan_admin" placeholder="Tambahkan catatan resolusi..." />

                <div class="flex items-center gap-3 pt-4">
                    <button type="submit" class="gov-btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    @endif
@endsection
