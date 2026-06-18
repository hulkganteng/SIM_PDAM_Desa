@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Tambah Pelanggan</h1>
        <p class="text-sm text-gray-500 mt-1">Daftarkan pelanggan baru</p>
    </div>

    <div class="gov-card p-6 max-w-2xl">
        <form method="POST" action="{{ url('/pelanggan') }}">
            @csrf

            <x-form-group label="Nama" name="nama" placeholder="Nama lengkap pelanggan" :required="true" />

            <x-form-group label="Alamat" name="alamat" type="textarea" placeholder="Alamat lengkap" :required="true" />

            <x-form-group label="No. HP" name="no_hp" placeholder="08xxxxxxxxxx" :required="true" />

            <x-form-group label="Golongan Tarif" name="golongan_id" type="select" :required="true">
                <option value="">Pilih Golongan</option>
                @foreach($golongan as $g)
                    <option value="{{ $g->id }}" {{ old('golongan_id') == $g->id ? 'selected' : '' }}>
                        {{ $g->nama }} - Rp {{ number_format($g->tarif_per_m3, 0, ',', '.') }}/m³
                    </option>
                @endforeach
            </x-form-group>

            <x-form-group label="Akun Pengguna (Opsional)" name="user_id" type="select">
                <option value="">Tanpa Akun Portal</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                        {{ $u->name }} ({{ $u->email }})
                    </option>
                @endforeach
            </x-form-group>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="gov-btn-primary">Simpan</button>
                <a href="{{ url('/pelanggan') }}" class="gov-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
