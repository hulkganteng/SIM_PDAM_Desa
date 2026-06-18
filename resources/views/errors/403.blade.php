<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#EEF2F7] min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
        </div>
        <h1 class="text-6xl font-bold text-[#1A3A5C] mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-[#64748B] mb-4">Akses Ditolak</h2>
        <p class="text-[#64748B] mb-8 max-w-md mx-auto">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.</p>
        <div class="flex items-center justify-center gap-3">
            <a href="javascript:history.back()" class="gov-btn-secondary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            <a href="{{ url('/dashboard') }}" class="gov-btn-primary">Dashboard</a>
        </div>
    </div>
</body>
</html>
