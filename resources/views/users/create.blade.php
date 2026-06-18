@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Pengguna</h1>
        <p class="text-gray-500 mt-1">Buat akun pengguna baru</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
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

            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                    Simpan
                </button>
                <a href="{{ url('/users') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
