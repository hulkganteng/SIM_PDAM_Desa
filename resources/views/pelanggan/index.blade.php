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
                                    <button type="button" @click="$dispatch('open-edit-pelanggan-{{ $p->id }}')" class="text-[#1A3A5C] font-medium hover:underline">Edit</button>
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

    @if(auth()->user()->role === 'admin')
        @foreach($pelanggan as $p)
            <div x-data="{ open: {{ old('_edit_id') == $p->id ? 'true' : 'false' }} }"
                 x-on:open-edit-pelanggan-{{ $p->id }}.window="open = true"
                 x-on:keydown.escape.window="open = false"
                 x-show="open"
                 x-cloak
                 class="fixed inset-0 z-50 overflow-y-auto"
                 role="dialog"
                 aria-modal="true"
                 aria-labelledby="edit-pelanggan-title-{{ $p->id }}">
                <div x-show="open"
                     x-transition.opacity
                     @click="open = false"
                     class="fixed inset-0 bg-[#1A3A5C]/60"></div>

                <div class="flex min-h-full items-center justify-center p-4">
                    <div x-show="open"
                         x-transition
                         class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">
                        <div class="flex items-start justify-between gap-4 border-b border-[#E2E8F0] px-6 py-4">
                            <div>
                                <h2 id="edit-pelanggan-title-{{ $p->id }}" class="text-lg font-semibold text-[#1A3A5C]">Edit Pelanggan</h2>
                                <p class="mt-1 text-sm text-gray-500">{{ $p->no_sambungan }} - {{ $p->nama }}</p>
                            </div>
                            <button type="button" @click="open = false" class="rounded-lg p-2 text-gray-500 hover:bg-[#EEF2F7]" aria-label="Tutup">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form method="POST" action="{{ url('/pelanggan/' . $p->id) }}" class="max-h-[75vh] overflow-y-auto px-6 py-5">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_edit_id" value="{{ $p->id }}">

                            <x-form-group label="Nama" name="nama" :value="$p->nama" placeholder="Nama lengkap pelanggan" :required="true" />

                            <x-form-group label="Alamat" name="alamat" type="textarea" :value="$p->alamat" placeholder="Alamat lengkap" :required="true" />

                            <x-form-group label="No. HP" name="no_hp" :value="$p->no_hp" placeholder="08xxxxxxxxxx" :required="true" />

                            <x-form-group label="Golongan Tarif" name="golongan_id" type="select" :required="true">
                                @foreach($golongan as $g)
                                    <option value="{{ $g->id }}" {{ old('golongan_id', $p->golongan_id) == $g->id ? 'selected' : '' }}>
                                        {{ $g->nama }} - Rp {{ number_format($g->tarif_per_m3, 0, ',', '.') }}/m³
                                    </option>
                                @endforeach
                            </x-form-group>

                            <x-form-group label="Status" name="status" type="select" :required="true">
                                <option value="aktif" {{ old('status', $p->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $p->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                <option value="diputus" {{ old('status', $p->status) === 'diputus' ? 'selected' : '' }}>Diputus</option>
                            </x-form-group>

                            <x-form-group label="Akun Pengguna (Opsional)" name="user_id" type="select">
                                <option value="">Tanpa Akun Portal</option>
                                @foreach($users as $u)
                                    @if(! $u->pelanggan || $u->id === $p->user_id)
                                        <option value="{{ $u->id }}" {{ old('user_id', $p->user_id) == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }} ({{ $u->email }})
                                        </option>
                                    @endif
                                @endforeach
                            </x-form-group>

                            <div class="sticky bottom-0 -mx-6 mt-2 flex justify-end gap-3 border-t border-[#E2E8F0] bg-[#F8FAFC] px-6 py-4">
                                <button type="button" @click="open = false" class="gov-btn-secondary">Batal</button>
                                <button type="submit" class="gov-btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
