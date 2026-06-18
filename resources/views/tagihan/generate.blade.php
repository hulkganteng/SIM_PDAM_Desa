@extends('layouts.app')

@section('title', 'Generate Tagihan')

@section('content')
    <div class="mb-6">
        <h1 class="gov-page-title">Generate Tagihan</h1>
        <p class="text-sm text-gray-500 mt-1">Generate tagihan otomatis berdasarkan pencatatan meter</p>
    </div>

    <div class="gov-card p-6 mb-6 max-w-2xl">
        <form method="POST" action="{{ url('/tagihan/generate') }}">
            @csrf

            <x-form-group label="Periode" name="periode" type="month" :value="old('periode', date('Y-m'))" :required="true" />

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="gov-btn-primary" onclick="return confirm('Generate tagihan untuk periode ini?')">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Generate Tagihan
                </button>
                <a href="{{ url('/tagihan') }}" class="gov-btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    {{-- Results Display --}}
    @if(session('generated'))
        <div class="gov-card p-6 max-w-2xl">
            <h2 class="gov-section-title mb-4">Hasil Generate</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                    <p class="text-sm text-emerald-600">Tagihan Dibuat</p>
                    <p class="text-2xl font-semibold text-emerald-800">{{ session('generated.created') }}</p>
                </div>
                <div class="bg-amber-50 rounded-xl p-4 border border-amber-200">
                    <p class="text-sm text-amber-600">Dilewati (Sudah Ada)</p>
                    <p class="text-2xl font-semibold text-amber-800">{{ session('generated.skipped') }}</p>
                </div>
            </div>
        </div>
    @endif
@endsection
