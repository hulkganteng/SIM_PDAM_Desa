@extends('layouts.app')

@section('title', 'Tambah Golongan Tarif')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Tambah Golongan Tarif</h1>
        <p class="text-sm text-gray-500 mt-1">Buat golongan tarif baru</p>
    </div>

    <div class="gov-card p-6 max-w-2xl">
        <form method="POST" action="{{ url('/golongan-tarif') }}">
            @csrf

            <x-form-group label="Nama Golongan" name="nama" placeholder="Contoh: Rumah Tangga A" :required="true" />

            <x-form-group label="Tarif per m³ (Rp)" name="tarif_per_m3" type="number" placeholder="0" :required="true" />

            <x-form-group label="Biaya Beban (Rp)" name="biaya_beban" type="number" placeholder="0" :required="true" />

            <x-form-group label="Denda Keterlambatan (Rp)" name="denda" type="number" placeholder="0" :required="true" />

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="gov-btn-primary">Simpan</button>
                <a href="{{ url('/golongan-tarif') }}" class="gov-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
