<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganTarifController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PencatatanMeterController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware(['auth', 'check.status'])->group(function () {

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('golongan-tarif', GolonganTarifController::class);
        Route::resource('pengaduan', PengaduanController::class)->only(['index', 'show', 'update']);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/tagihan', [LaporanController::class, 'tagihan'])->name('laporan.tagihan');
        Route::get('/laporan/pembayaran', [LaporanController::class, 'pembayaran'])->name('laporan.pembayaran');
        Route::get('/laporan/pelanggan', [LaporanController::class, 'pelanggan'])->name('laporan.pelanggan');
        Route::get('/laporan/export/{type}/{format}', [LaporanController::class, 'export'])->name('laporan.export');
        Route::get('/tagihan/generate', [TagihanController::class, 'showGenerate'])->name('tagihan.generate.form');
        Route::post('/tagihan/generate', [TagihanController::class, 'generate'])->name('tagihan.generate');
        Route::post('/tagihan/apply-denda', [TagihanController::class, 'applyDenda'])->name('tagihan.applyDenda');
    });

    // Petugas routes (admin + petugas)
    Route::middleware('role:admin,petugas')->group(function () {
        Route::resource('meter', PencatatanMeterController::class);
        // Route::get('/pelanggan-list', [PelangganController::class, 'index'])->name('petugas.pelanggan');
        // Route::get('/pelanggan-list/{pelanggan}', [PelangganController::class, 'show'])->name('petugas.pelanggan.show');
    });

    // Tagihan & Pembayaran (admin + kasir + petugas)
    Route::middleware('role:admin,kasir,petugas')->group(function () {
        Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::get('/tagihan/cetak-massal', [TagihanController::class, 'cetakMassal'])->name('tagihan.cetakMassal');
        Route::get('/tagihan/{tagihan}', [TagihanController::class, 'show'])->name('tagihan.show');
        Route::resource('pembayaran', PembayaranController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('/pembayaran/{pembayaran}/receipt', [PembayaranController::class, 'receipt'])->name('pembayaran.receipt');
    });

    // Pelanggan (customer portal) routes
    Route::middleware('role:pelanggan')->prefix('portal')->name('portal.')->group(function () {
        Route::get('/tagihan', [PortalController::class, 'tagihan'])->name('tagihan');
        Route::get('/tagihan/{tagihan}', [PortalController::class, 'showTagihan'])->name('tagihan.show');
        Route::get('/pemakaian', [PortalController::class, 'pemakaian'])->name('pemakaian');
        Route::get('/pembayaran', [PortalController::class, 'pembayaran'])->name('pembayaran');
        Route::get('/pengaduan', [PortalController::class, 'pengaduan'])->name('pengaduan');
        Route::post('/pengaduan', [PortalController::class, 'storePengaduan'])->name('pengaduan.store');
        Route::get('/profil', [PortalController::class, 'profil'])->name('profil');
    });
});
