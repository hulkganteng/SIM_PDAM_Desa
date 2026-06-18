@extends('layouts.portal')

@section('title', 'Pengaduan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaduan</h1>
        <p class="text-gray-500 mt-1">Sampaikan keluhan atau pengaduan Anda</p>
    </div>

    {{-- Submission Form --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Buat Pengaduan Baru</h2>
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

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                Kirim Pengaduan
            </button>
        </form>
    </div>

    {{-- Complaints List --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Pengaduan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pengaduan as $p)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">
                                    {{ str_replace('_', ' ', $p->kategori) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ Str::limit($p->deskripsi, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($p->status === 'baru') bg-yellow-100 text-yellow-800
                                    @elseif($p->status === 'diproses') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengaduan->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $pengaduan->links() }}
            </div>
        @endif
    </div>
@endsection
