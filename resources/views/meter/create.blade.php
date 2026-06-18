@extends('layouts.app')

@section('title', 'Catat Meter')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Catat Meter</h1>
        <p class="text-gray-500 mt-1">Input pencatatan meter pelanggan</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Pemakaian (m³)</label>
                <div id="pemakaian-preview" class="block w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-sm text-gray-900 font-medium">
                    0
                </div>
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Meter</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('foto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                    Simpan
                </button>
                <a href="{{ url('/meter') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </a>
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
            preview.classList.toggle('text-gray-900', pemakaian >= 0);
        }

        meterAwal.addEventListener('input', updatePemakaian);
        meterAkhir.addEventListener('input', updatePemakaian);
        updatePemakaian();
    });
</script>
@endpush
