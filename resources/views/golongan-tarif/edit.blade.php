@extends('layouts.app')

@section('title', 'Edit Golongan Tarif')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Edit Golongan Tarif</h1>
        <p class="text-sm text-gray-500 mt-1">Ubah data: {{ $golonganTarif->nama }}</p>
    </div>

    <div class="gov-card p-6 max-w-2xl">
        <form method="POST" action="{{ url('/golongan-tarif/' . $golonganTarif->id) }}">
            @csrf
            @method('PUT')

            <x-form-group label="Nama Golongan" name="nama" :value="$golonganTarif->nama" placeholder="Contoh: Rumah Tangga A" :required="true" />

            <x-form-group label="Tarif per m³ (Rp)" name="tarif_per_m3" type="number" :value="$golonganTarif->tarif_per_m3" placeholder="0" :required="true" />

            <x-form-group label="Biaya Beban (Rp)" name="biaya_beban" type="number" :value="$golonganTarif->biaya_beban" placeholder="0" :required="true" />

            <x-form-group label="Denda Keterlambatan (Rp)" name="denda" type="number" :value="$golonganTarif->denda" placeholder="0" :required="true" />

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="gov-btn-primary">Perbarui</button>
                <a href="{{ url('/golongan-tarif') }}" class="gov-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
