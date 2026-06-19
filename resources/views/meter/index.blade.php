@extends('layouts.app')

@section('title', 'Pencatatan Meter')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Pencatatan Meter</h1>
        <a href="{{ url('/meter/create') }}" class="gov-btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Catat Meter
        </a>
    </div>

    {{-- Period Filter --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/meter') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="sm:w-56">
                <input type="month" name="periode" value="{{ request('periode', date('Y-m')) }}" class="gov-input">
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
                        <th>Periode</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        <th>Pemakaian</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meters as $meter)
                        <tr>
                            <td class="whitespace-nowrap">
                                <span class="text-[#1A3A5C] font-medium">{{ $meter->pelanggan->nama ?? '-' }}</span>
                                <span class="block text-xs text-gray-500">{{ $meter->pelanggan->no_sambungan ?? '' }}</span>
                            </td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->meter_awal }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->meter_akhir }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $meter->pemakaian }} m³</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->petugas->name ?? '-' }}</td>
                            <td class="whitespace-nowrap space-x-3">
                                <a href="{{ url('/meter/' . $meter->id) }}" class="text-[#1A3A5C] font-medium hover:underline">Detail</a>
                                <button type="button" @click="$dispatch('open-edit-meter-{{ $meter->id }}')" class="text-[#1A3A5C] font-medium hover:underline">Edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">Belum ada pencatatan meter untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($meters->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $meters->links() }}
            </div>
        @endif
    </div>

    @foreach($meters as $meter)
        <div x-data="{ open: {{ old('_edit_id') == $meter->id ? 'true' : 'false' }} }"
             x-on:open-edit-meter-{{ $meter->id }}.window="open = true"
             x-on:keydown.escape.window="open = false"
             x-show="open"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             role="dialog"
             aria-modal="true"
             aria-labelledby="edit-meter-title-{{ $meter->id }}">
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
                            <h2 id="edit-meter-title-{{ $meter->id }}" class="text-lg font-semibold text-[#1A3A5C]">Edit Pencatatan Meter</h2>
                            <p class="mt-1 text-sm text-gray-500">{{ $meter->pelanggan->nama ?? '-' }} - Periode {{ $meter->periode }}</p>
                        </div>
                        <button type="button" @click="open = false" class="rounded-lg p-2 text-gray-500 hover:bg-[#EEF2F7]" aria-label="Tutup">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST"
                          action="{{ url('/meter/' . $meter->id) }}"
                          enctype="multipart/form-data"
                          class="max-h-[75vh] overflow-y-auto px-6 py-5"
                          x-data="{
                              meterAwal: {{ (int) old('meter_awal', $meter->meter_awal) }},
                              meterAkhir: {{ (int) old('meter_akhir', $meter->meter_akhir) }},
                              get pemakaian() {
                                  return this.meterAkhir - this.meterAwal;
                              }
                          }">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_edit_id" value="{{ $meter->id }}">

                        <x-form-group label="Pelanggan" name="pelanggan_id" type="select" :required="true">
                            @foreach($pelanggan as $p)
                                <option value="{{ $p->id }}" {{ old('pelanggan_id', $meter->pelanggan_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->no_sambungan }} - {{ $p->nama }}
                                </option>
                            @endforeach
                        </x-form-group>

                        <x-form-group label="Periode" name="periode" type="month" :value="$meter->periode" :required="true" />

                        <x-form-group label="Meter Awal" name="meter_awal" type="number" :value="$meter->meter_awal" :required="true" x-model.number="meterAwal" />

                        <x-form-group label="Meter Akhir" name="meter_akhir" type="number" :value="$meter->meter_akhir" :required="true" x-model.number="meterAkhir" />

                        <div class="mb-4">
                            <label class="gov-label">Pemakaian (m³)</label>
                            <div class="w-full rounded-lg border border-gray-300 bg-[#F8FAFC] px-3.5 py-2.5 text-sm font-medium"
                                 :class="pemakaian < 0 ? 'text-red-600' : 'text-[#1A3A5C]'">
                                <span x-text="pemakaian >= 0 ? pemakaian + ' m³' : 'Invalid (meter akhir < awal)'"></span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto-{{ $meter->id }}" class="gov-label">Foto Meter (Baru)</label>
                            <input type="file" id="foto-{{ $meter->id }}" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#EEF2F7] file:text-[#1A3A5C] hover:file:bg-[#DCE6F0]">
                            @if($meter->foto)
                                <p class="mt-1 text-xs text-gray-500">Foto saat ini tersedia. Upload baru untuk mengganti.</p>
                            @endif
                            @error('foto')
                                <p class="gov-error-text">{{ $message }}</p>
                            @enderror
                        </div>

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
