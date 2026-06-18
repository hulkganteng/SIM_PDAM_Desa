@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="mb-5">
        <h2 class="text-lg font-semibold text-[#1A3A5C]">Masuk ke Akun Anda</h2>
        <p class="text-xs text-[#64748B] mt-0.5">Masukkan kredensial untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <x-form-group label="Email" name="email" type="email" :value="old('email')" placeholder="nama@email.com" :required="true" />

        <x-form-group label="Password" name="password" type="password" placeholder="Masukkan password" :required="true" />

        <div class="flex items-center justify-between mb-5">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#1A3A5C] focus:ring-[#4FC3F7]">
                <span class="ml-2 text-xs text-[#64748B]">Ingat saya</span>
            </label>
        </div>

        <button type="submit" class="gov-btn-primary w-full justify-center">
            Masuk
        </button>
    </form>
@endsection
