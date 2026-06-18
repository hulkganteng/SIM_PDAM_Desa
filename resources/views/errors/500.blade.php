<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#EEF2F7] min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h1 class="text-6xl font-bold text-[#1A3A5C] mb-4">500</h1>
        <h2 class="text-2xl font-semibold text-[#64748B] mb-4">Terjadi Kesalahan</h2>
        <p class="text-[#64748B] mb-8 max-w-md mx-auto">Maaf, terjadi kesalahan pada server. Tim kami telah diberitahu dan sedang memperbaikinya. Silakan coba lagi nanti.</p>
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
