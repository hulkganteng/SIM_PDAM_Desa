@extends('layouts.app')

@section('title', 'Pencatatan Meter')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pencatatan Meter</h1>
        <a href="{{ url('/meter/create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Catat Meter
        </a>
    </div>

    {{-- Period Filter --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="{{ url('/meter') }}" class="flex flex-col sm:flex-row gap-3">
            <div>
                <input type="month" name="periode" value="{{ request('periode', date('Y-m')) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meter Awal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meter Akhir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemakaian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($meters as $meter)
                        <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $meter->pelanggan->nama ?? '-' }}
                                <span class="block text-xs text-gray-500">{{ $meter->pelanggan->no_sambungan ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->periode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->meter_awal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->meter_akhir }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $meter->pemakaian }} m³</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $meter->petugas->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                <a href="{{ url('/meter/' . $meter->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                <a href="{{ url('/meter/' . $meter->id . '/edit') }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada pencatatan meter untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($meters->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $meters->links() }}
            </div>
        @endif
    </div>
@endsection
