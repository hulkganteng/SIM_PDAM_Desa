@extends('layouts.app')

@section('title', 'Golongan Tarif')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Golongan Tarif</h1>
        <a href="{{ url('/golongan-tarif/create') }}" class="gov-btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Golongan
        </a>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tarif/m³</th>
                        <th>Biaya Beban</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($golongan as $g)
                        <tr>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $g->nama }}</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($g->tarif_per_m3, 0, ',', '.') }}</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($g->biaya_beban, 0, ',', '.') }}</td>
                            <td class="text-gray-600 whitespace-nowrap">Rp {{ number_format($g->denda, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap space-x-3">
                                <a href="{{ url('/golongan-tarif/' . $g->id . '/edit') }}" class="text-[#1A3A5C] font-medium hover:underline">Edit</a>
                                <form method="POST" action="{{ url('/golongan-tarif/' . $g->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus golongan tarif ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-medium hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500">Belum ada data golongan tarif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
