@extends('layouts.app')

@section('title', 'Tambah Golongan Tarif')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Golongan Tarif</h1>
        <p class="text-gray-500 mt-1">Buat golongan tarif baru</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ url('/golongan-tarif') }}">
            @csrf

            <x-form-group label="Nama Golongan" name="nama" placeholder="Contoh: Rumah Tangga A" :required="true" />

            <x-form-group label="Tarif per m³ (Rp)" name="tarif_per_m3" type="number" placeholder="0" :required="true" />

            <x-form-group label="Biaya Beban (Rp)" name="biaya_beban" type="number" placeholder="0" :required="true" />

            <x-form-group label="Denda Keterlambatan (Rp)" name="denda" type="number" placeholder="0" :required="true" />

            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                    Simpan
                </button>
                <a href="{{ url('/golongan-tarif') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
