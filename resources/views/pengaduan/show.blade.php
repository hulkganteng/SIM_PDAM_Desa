@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pengaduan</h1>
                <p class="text-gray-500 mt-1">{{ $pengaduan->pelanggan->nama ?? '-' }} - {{ $pengaduan->tanggal->format('d/m/Y') }}</p>
            </div>
            <a href="{{ url('/pengaduan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                Kembali
            </a>
        </div>
    </div>

    {{-- Complaint Detail --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Pelanggan</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pengaduan->pelanggan->nama ?? '-' }}</p>
                <p class="text-xs text-gray-500">{{ $pengaduan->pelanggan->no_sambungan ?? '' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 capitalize mt-1">
                    {{ str_replace('_', ' ', $pengaduan->kategori) }}
                </span>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tanggal Pengaduan</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $pengaduan->tanggal->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Status</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                    @if($pengaduan->status === 'baru') bg-yellow-100 text-yellow-800
                    @elseif($pengaduan->status === 'diproses') bg-blue-100 text-blue-800
                    @else bg-green-100 text-green-800
                    @endif">
                    {{ ucfirst($pengaduan->status) }}
                </span>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi</h3>
            <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-900">
                {{ $pengaduan->deskripsi }}
            </div>
        </div>

        @if($pengaduan->catatan_admin)
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Catatan Admin</h3>
                <div class="bg-blue-50 rounded-lg p-4 text-sm text-gray-900">
                    {{ $pengaduan->catatan_admin }}
                </div>
            </div>
        @endif
    </div>

    {{-- Status Update Form --}}
    @if($pengaduan->status !== 'selesai')
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Update Status</h2>
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

                <div class="flex items-center space-x-3 pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection
