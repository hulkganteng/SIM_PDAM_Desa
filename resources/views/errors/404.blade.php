<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#EEF2F7] min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-[#4FC3F7]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-6xl font-bold text-[#1A3A5C] mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-[#64748B] mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-[#64748B] mb-8 max-w-md mx-auto">Halaman yang Anda cari tidak ditemukan. Mungkin halaman telah dipindahkan atau dihapus.</p>
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
