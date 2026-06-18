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
                                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="text-[#1A3A5C] font-medium hover:underline">Edit</a>
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
@endsection
