@extends('layouts.app')

@section('title', 'Catat Meter')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Catat Meter</h1>
        <p class="text-sm text-gray-500 mt-1">Input pencatatan meter pelanggan</p>
    </div>

    <div class="gov-card p-6 max-w-2xl">
        <form method="POST" action="{{ url('/meter') }}" enctype="multipart/form-data">
            @csrf

            <x-form-group label="Pelanggan" name="pelanggan_id" type="select" :required="true">
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->no_sambungan }} - {{ $p->nama }}
                    </option>
                @endforeach
            </x-form-group>

            <x-form-group label="Periode" name="periode" type="month" :value="old('periode', date('Y-m'))" :required="true" />

            <x-form-group label="Meter Awal" name="meter_awal" type="number" :value="old('meter_awal')" placeholder="Otomatis dari periode sebelumnya" :required="true" />

            <x-form-group label="Meter Akhir" name="meter_akhir" type="number" :value="old('meter_akhir')" placeholder="Angka meter saat ini" :required="true" />

            {{-- Pemakaian Preview --}}
            <div class="mb-4">
                <label class="gov-label">Pemakaian (m³)</label>
                <div id="pemakaian-preview" class="w-full rounded-lg border border-gray-300 bg-[#F8FAFC] px-3.5 py-2.5 text-sm text-[#1A3A5C] font-medium">
                    0
                </div>
            </div>

            <div class="mb-4">
                <label for="foto" class="gov-label">Foto Meter</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#EEF2F7] file:text-[#1A3A5C] hover:file:bg-[#DCE6F0]">
                @error('foto')
                    <p class="gov-error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="gov-btn-primary">Simpan</button>
                <a href="{{ url('/meter') }}" class="gov-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const meterAwal = document.getElementById('meter_awal');
        const meterAkhir = document.getElementById('meter_akhir');
        const preview = document.getElementById('pemakaian-preview');

        function updatePemakaian() {
            const awal = parseInt(meterAwal.value) || 0;
            const akhir = parseInt(meterAkhir.value) || 0;
            const pemakaian = akhir - awal;
            preview.textContent = pemakaian >= 0 ? pemakaian + ' m³' : 'Invalid (meter akhir < awal)';
            preview.classList.toggle('text-red-600', pemakaian < 0);
            preview.classList.toggle('text-[#1A3A5C]', pemakaian >= 0);
        }

        meterAwal.addEventListener('input', updatePemakaian);
        meterAkhir.addEventListener('input', updatePemakaian);
        updatePemakaian();
    });
</script>
@endpush
