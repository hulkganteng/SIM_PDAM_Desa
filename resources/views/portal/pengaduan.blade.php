@extends('layouts.portal')

@section('title', 'Pengaduan')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Pengaduan</h1>
        <p class="text-sm text-gray-500 mt-1">Sampaikan keluhan atau pengaduan Anda</p>
    </div>

    {{-- Submission Form --}}
    <div class="gov-card p-6 mb-6">
        <h2 class="gov-section-title mb-4">Buat Pengaduan Baru</h2>
        <form method="POST" action="{{ url('/portal/pengaduan') }}">
            @csrf

            <x-form-group label="Kategori" name="kategori" type="select" :required="true">
                <option value="">Pilih Kategori</option>
                <option value="air_mati" {{ old('kategori') === 'air_mati' ? 'selected' : '' }}>Air Mati</option>
                <option value="kebocoran" {{ old('kategori') === 'kebocoran' ? 'selected' : '' }}>Kebocoran</option>
                <option value="meter_rusak" {{ old('kategori') === 'meter_rusak' ? 'selected' : '' }}>Meter Rusak</option>
                <option value="lainnya" {{ old('kategori') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </x-form-group>

            <x-form-group label="Deskripsi" name="deskripsi" type="textarea" placeholder="Jelaskan masalah Anda secara detail..." :required="true" />

            <button type="submit" class="gov-btn-primary">Kirim Pengaduan</button>
        </form>
    </div>

    {{-- Complaints List --}}
    <div class="gov-card overflow-hidden">
        <div class="px-6 py-4 border-b border-[#E2E8F0]">
            <h2 class="gov-section-title">Riwayat Pengaduan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $p)
                        <tr>
                            <td class="text-gray-600 whitespace-nowrap">{{ $p->tanggal->format('d/m/Y') }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">Belum ada pengaduan.</td>
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
