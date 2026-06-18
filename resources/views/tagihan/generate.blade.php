@extends('layouts.app')

@section('title', 'Generate Tagihan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Generate Tagihan</h1>
        <p class="text-gray-500 mt-1">Generate tagihan otomatis berdasarkan pencatatan meter</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <form method="POST" action="{{ url('/tagihan/generate') }}">
            @csrf

            <x-form-group label="Periode" name="periode" type="month" :value="old('periode', date('Y-m'))" :required="true" />

            <div class="flex items-center space-x-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors" onclick="return confirm('Generate tagihan untuk periode ini?')">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Generate Tagihan
                </button>
                <a href="{{ url('/tagihan') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Results Display --}}
    @if(session('generated'))
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Hasil Generate</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <p class="text-sm text-green-600">Tagihan Dibuat</p>
                    <p class="text-2xl font-bold text-green-800">{{ session('generated.created') }}</p>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                    <p class="text-sm text-yellow-600">Dilewati (Sudah Ada)</p>
                    <p class="text-2xl font-bold text-yellow-800">{{ session('generated.skipped') }}</p>
                </div>
            </div>
        </div>
    @endif
@endsection
