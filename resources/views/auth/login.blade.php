@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <h2 class="text-xl font-semibold text-gray-800 text-center mb-6">Masuk ke Akun Anda</h2>

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <x-form-group label="Email" name="email" type="email" :value="old('email')" placeholder="nama@email.com" :required="true" />

        <x-form-group label="Password" name="password" type="password" placeholder="Masukkan password" :required="true" />

        <div class="flex items-center justify-between mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            Masuk
        </button>
    </form>
@endsection
