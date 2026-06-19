@extends('layouts.app')

@section('title', 'Golongan Tarif')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Golongan Tarif</h1>
        <a href="{{ url('/golongan-tarif/create') }}" class="gov-btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Golongan
        </a>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tarif/m³</th>
                        <th>Biaya Beban</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($golongan as $g)
                        <tr>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $g->nama }}</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($g->tarif_per_m3, 0, ',', '.') }}</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($g->biaya_beban, 0, ',', '.') }}</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($g->denda, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap space-x-3">
                                <button type="button" @click="$dispatch('open-edit-golongan-{{ $g->id }}')" class="text-[#1A3A5C] font-medium hover:underline">Edit</button>
                                <form method="POST" action="{{ url('/golongan-tarif/' . $g->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus golongan tarif ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-medium hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Belum ada data golongan tarif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @foreach($golongan as $g)
        <div x-data="{ open: {{ old('_edit_id') == $g->id ? 'true' : 'false' }} }"
             x-on:open-edit-golongan-{{ $g->id }}.window="open = true"
             x-on:keydown.escape.window="open = false"
             x-show="open"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             role="dialog"
             aria-modal="true"
             aria-labelledby="edit-golongan-title-{{ $g->id }}">
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
                            <h2 id="edit-golongan-title-{{ $g->id }}" class="text-lg font-semibold text-[#1A3A5C]">Edit Golongan Tarif</h2>
                            <p class="mt-1 text-sm text-gray-500">Ubah data: {{ $g->nama }}</p>
                        </div>
                        <button type="button" @click="open = false" class="rounded-lg p-2 text-gray-500 hover:bg-[#EEF2F7]" aria-label="Tutup">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ url('/golongan-tarif/' . $g->id) }}" class="max-h-[75vh] overflow-y-auto px-6 py-5">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_edit_id" value="{{ $g->id }}">

                        <x-form-group label="Nama Golongan" name="nama" :value="$g->nama" placeholder="Contoh: Rumah Tangga A" :required="true" />

                        <x-form-group label="Tarif per m³ (Rp)" name="tarif_per_m3" type="number" :value="$g->tarif_per_m3" placeholder="0" :required="true" />

                        <x-form-group label="Biaya Beban (Rp)" name="biaya_beban" type="number" :value="$g->biaya_beban" placeholder="0" :required="true" />

                        <x-form-group label="Denda Keterlambatan (Rp)" name="denda" type="number" :value="$g->denda" placeholder="0" :required="true" />

                        <div class="sticky bottom-0 -mx-6 mt-2 flex justify-end gap-3 border-t border-[#E2E8F0] bg-[#F8FAFC] px-6 py-4">
                            <button type="button" @click="open = false" class="gov-btn-secondary">Batal</button>
                            <button type="submit" class="gov-btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
