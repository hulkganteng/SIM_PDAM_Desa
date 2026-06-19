@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Manajemen Pengguna</h1>
        <a href="{{ url('/users/create') }}" class="gov-btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pengguna
        </a>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $user->name }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge capitalize
                                    @if($user->role === 'admin') bg-purple-100 text-purple-800
                                    @elseif($user->role === 'petugas') gov-badge-info
                                    @elseif($user->role === 'kasir') gov-badge-success
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap">
                                <span class="gov-badge {{ $user->status === 'aktif' ? 'gov-badge-success' : 'gov-badge-danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap space-x-3">
                                <button type="button" @click="$dispatch('open-edit-user-{{ $user->id }}')" class="text-[#1A3A5C] font-medium hover:underline">Edit</button>
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ url('/users/' . $user->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menonaktifkan pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-medium hover:underline">Nonaktifkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    @foreach($users as $user)
        <div x-data="{ open: {{ old('_edit_id') == $user->id ? 'true' : 'false' }} }"
             x-on:open-edit-user-{{ $user->id }}.window="open = true"
             x-on:keydown.escape.window="open = false"
             x-show="open"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             role="dialog"
             aria-modal="true"
             aria-labelledby="edit-user-title-{{ $user->id }}">
            <div x-show="open"
                 x-transition.opacity
                 @click="open = false"
                 class="fixed inset-0 bg-[#1A3A5C]/60"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="open"
                     x-transition
                     class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl">
                    <div class="flex items-start justify-between gap-4 border-b border-[#E2E8F0] px-6 py-4">
                        <div>
                            <h2 id="edit-user-title-{{ $user->id }}" class="text-lg font-semibold text-[#1A3A5C]">Edit Pengguna</h2>
                            <p class="mt-1 text-sm text-gray-500">Ubah data pengguna: {{ $user->name }}</p>
                        </div>
                        <button type="button" @click="open = false" class="rounded-lg p-2 text-gray-500 hover:bg-[#EEF2F7]" aria-label="Tutup">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ url('/users/' . $user->id) }}" class="max-h-[75vh] overflow-y-auto px-6 py-5">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_edit_id" value="{{ $user->id }}">

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

                        <div class="sticky bottom-0 -mx-6 mt-2 flex justify-end gap-3 border-t border-[#E2E8F0] bg-[#F8FAFC] px-6 py-4">
                            <button type="button" @click="open = false" class="gov-btn-secondary">Batal</button>
                            <button type="submit" class="gov-btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
