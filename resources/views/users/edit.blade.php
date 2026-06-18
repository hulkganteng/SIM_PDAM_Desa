@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pengguna</h1>
        <p class="text-gray-500 mt-1">Ubah data pengguna: {{ $user->name }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ url('/users/' . $user->id) }}">
            @csrf
            @method('PUT')

            <x-form-group label="Nama" name="name" :value="$user->name" placeholder="Nama lengkap" :required="true" />

            <x-form-group label="Email" name="email" type="email" :value="$user->email" placeholder="email@example.com" :required="true" />

            <x-form-group label="Role" name="role" type="select" :required="true">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="kasir" {{ old('role', $user->role) === 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="pelanggan" {{ old('role', $user->role) === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
            </x-form-group>

            <x-form-group label="Status" name="status" type="select" :required="true">
                <option value="aktif" {{ old('status', $user->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $user->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </x-form-group>

            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                    Perbarui
                </button>
                <a href="{{ url('/users') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
