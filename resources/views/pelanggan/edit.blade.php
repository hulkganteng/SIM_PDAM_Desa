@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pelanggan</h1>
        <p class="text-gray-500 mt-1">{{ $pelanggan->no_sambungan }} - {{ $pelanggan->nama }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ url('/pelanggan/' . $pelanggan->id) }}">
            @csrf
            @method('PUT')

            <x-form-group label="Nama" name="nama" :value="$pelanggan->nama" placeholder="Nama lengkap pelanggan" :required="true" />

            <x-form-group label="Alamat" name="alamat" type="textarea" :value="$pelanggan->alamat" placeholder="Alamat lengkap" :required="true" />

            <x-form-group label="No. HP" name="no_hp" :value="$pelanggan->no_hp" placeholder="08xxxxxxxxxx" :required="true" />

            <x-form-group label="Golongan Tarif" name="golongan_id" type="select" :required="true">
                @foreach($golongan as $g)
                    <option value="{{ $g->id }}" {{ old('golongan_id', $pelanggan->golongan_id) == $g->id ? 'selected' : '' }}>
                        {{ $g->nama }} - Rp {{ number_format($g->tarif_per_m3, 0, ',', '.') }}/m³
                    </option>
                @endforeach
            </x-form-group>

            <x-form-group label="Status" name="status" type="select" :required="true">
                <option value="aktif" {{ old('status', $pelanggan->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $pelanggan->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                <option value="diputus" {{ old('status', $pelanggan->status) === 'diputus' ? 'selected' : '' }}>Diputus</option>
            </x-form-group>

            <x-form-group label="Akun Pengguna (Opsional)" name="user_id" type="select">
                <option value="">Tanpa Akun Portal</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ old('user_id', $pelanggan->user_id) == $u->id ? 'selected' : '' }}>
                        {{ $u->name }} ({{ $u->email }})
                    </option>
                @endforeach
            </x-form-group>

            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                    Perbarui
                </button>
                <a href="{{ url('/pelanggan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
