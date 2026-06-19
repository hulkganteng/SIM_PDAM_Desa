@extends('layouts.portal')

@section('title', 'Riwayat Pemakaian')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Riwayat Pemakaian</h1>
        <p class="text-sm text-gray-500 mt-1">Pemakaian air berdasarkan pencatatan meter pelanggan</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="gov-card p-5">
            <p class="text-sm text-gray-500">Total 12 Periode Terakhir</p>
            <p class="text-2xl font-semibold text-[#1A3A5C] mt-1">{{ number_format($totalPemakaian, 0, ',', '.') }} m3</p>
        </div>
        <div class="gov-card p-5">
            <p class="text-sm text-gray-500">Rata-rata Pemakaian</p>
            <p class="text-2xl font-semibold text-[#1A3A5C] mt-1">{{ number_format($rataRataPemakaian, 1, ',', '.') }} m3</p>
        </div>
        <div class="gov-card p-5">
            <p class="text-sm text-gray-500">Pemakaian Tertinggi</p>
            <p class="text-2xl font-semibold text-[#1A3A5C] mt-1">{{ number_format($pemakaianTertinggi, 0, ',', '.') }} m3</p>
        </div>
    </div>

    <div class="gov-card p-6 mb-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="gov-section-title">Grafik 12 Periode Terakhir</h2>
        </div>
        @php $maxPemakaian = max((int) $pemakaianTertinggi, 1); @endphp
        @if($chartData->isNotEmpty())
            <div class="flex items-end gap-3 h-56 border-b border-[#CBD5E1] px-2 overflow-x-auto">
                @foreach($chartData as $item)
                    @php $height = max(8, ((int) $item->pemakaian / $maxPemakaian) * 100); @endphp
                    <div class="flex flex-col items-center justify-end min-w-14 h-full">
                        <div class="text-xs font-medium text-[#1A3A5C] mb-2">{{ $item->pemakaian }}</div>
                        <div class="w-9 rounded-t bg-[#1A3A5C]" style="height: {{ $height }}%;"></div>
                        <div class="text-xs text-gray-500 mt-2 whitespace-nowrap">{{ $item->periode }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">Belum ada data pemakaian.</p>
        @endif
    </div>

    <div class="gov-card overflow-hidden">
        <div class="px-6 py-4 border-b border-[#E2E8F0]">
            <h2 class="gov-section-title">Detail Pencatatan Meter</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="gov-table min-w-full">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Meter Awal</th>
                        <th>Meter Akhir</th>
                        <th>Pemakaian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemakaian as $meter)
                        <tr>
                            <td class="text-[#1A3A5C] whitespace-nowrap">{{ $meter->periode }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ number_format($meter->meter_awal, 0, ',', '.') }}</td>
                            <td class="text-gray-600 whitespace-nowrap">{{ number_format($meter->meter_akhir, 0, ',', '.') }}</td>
                            <td class="font-medium text-[#1A3A5C] whitespace-nowrap">{{ number_format($meter->pemakaian, 0, ',', '.') }} m3</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">Belum ada riwayat pemakaian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pemakaian->hasPages())
            <div class="bg-[#F8FAFC] px-5 py-3 border-t border-[#E2E8F0]">
                {{ $pemakaian->links() }}
            </div>
        @endif
    </div>
@endsection
