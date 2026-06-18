@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Tambah Pengguna</h1>
        <p class="text-sm text-gray-500 mt-1">Buat akun pengguna baru</p>
    </div>

    <div class="gov-card p-6 max-w-2xl">
        <form method="POST" action="{{ url('/users') }}">
            @csrf

            <x-form-group label="Nama" name="name" placeholder="Nama lengkap" :required="true" />

            <x-form-group label="Email" name="email" type="email" placeholder="email@example.com" :required="true" />

            <x-form-group label="Password" name="password" type="password" placeholder="Minimal 8 karakter" :required="true" />

            <x-form-group label="Konfirmasi Password" name="password_confirmation" type="password" placeholder="Ulangi password" :required="true" />

            <x-form-group label="Role" name="role" type="select" :required="true">
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ old('role') === 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="kasir" {{ old('role') === 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="pelanggan" {{ old('role') === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
            </x-form-group>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="gov-btn-primary">Simpan</button>
                <a href="{{ url('/users') }}" class="gov-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
