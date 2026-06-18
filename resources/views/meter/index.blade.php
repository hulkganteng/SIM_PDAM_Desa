@extends('layouts.app')

@section('title', 'Pencatatan Meter')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="gov-page-title">Pencatatan Meter</h1>
        <a href="{{ url('/meter/create') }}" class="gov-btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Catat Meter
        </a>
    </div>

    {{-- Period Filter --}}
    <div class="gov-card p-4 mb-6">
        <form method="GET" action="{{ url('/meter') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="sm:w-56">
                <input type="month" name="periode" value="{{ request('periode', date('Y-m')) }}" class="gov-input">
            </div>
            <button type="submit" class="gov-btn-primary">Filter</button>
        </form>
    </div>

    <div class="gov-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Periode</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        <th>Pemakaian</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meters as $meter)
                        <tr>
                            <td class="whitespace-nowrap">
                                <span class="text-[#1A3A5C] font-medium">{{ $meter->pelanggan->nama ?? '-' }}</span>
                                <span class="block text-xs text-gray-500">{{ $meter->pelanggan->no_sambungan ?? '' }}</span>
                            </td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->meter_awal }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->meter_akhir }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ $meter->pemakaian }} m³</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ $meter->petugas->name ?? '-' }}</td>
                            <td class="whitespace-nowrap space-x-3">
                                <a href="{{ url('/meter/' . $meter->id) }}" class="text-[#1A3A5C] font-medium hover:underline">Detail</a>
                                <a href="{{ url('/meter/' . $meter->id . '/edit') }}" class="text-[#1A3A5C] font-medium hover:underline">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">Belum ada pencatatan meter untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($meters->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $meters->links() }}
            </div>
        @endif
    </div>
@endsection
