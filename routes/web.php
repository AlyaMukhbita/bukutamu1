<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clogin;
use App\Http\Controllers\Cdashboard;
use App\Http\Controllers\Cttamu;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\TamuController;
use App\Exports\RekapitulasiExport;
use Maatwebsite\Excel\Facades\Excel;


    // Rute untuk login, yang tidak memerlukan middleware 'auth'
    Route::middleware(['guest'])->group(function () {
    Route::get('/login', [Clogin::class, 'index'])->name('login');
    Route::post('/login', [Clogin::class, 'login_proses'])->name('login_proses');
});

    // Rute untuk pengguna yang sudah login
    Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [Cdashboard::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [Cdashboard::class, 'index'])->name('dashboard.index');

    // Rute untuk Rekapitulasi
    Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.index');
    Route::post('/rekapitulasi/tampil', [RekapitulasiController::class, 'tampil'])->name('rekapitulasi.tampil');
    
    // Rute untuk ekspor rekapitulasi (pindahkan logika ekspor ke controller)
    Route::post('/rekapitulasi/export', [RekapitulasiController::class, 'export'])->name('rekapitulasi.export');

    // Rute untuk Tamu
    Route::get('/ttamu', [Cttamu::class, 'index'])->name('ttamu.index');
    Route::get('/ttamu/tambah', [Cttamu::class, 'tambah'])->name('ttamu.tambah');
    Route::post('/ttamu/simpan', [Cttamu::class, 'simpan'])->name('ttamu.simpan');
    Route::put('/ttamu/{nip}/update', [Cttamu::class, 'update'])->name('ttamu.update');
    Route::get('/ttamu/rekapitulasi', [Cttamu::class, 'rekapitulasi'])->name('ttamu.rekapitulasi');
    Route::get('/ttamu/tampilkan', [TamuController::class, 'tampilkan'])->name('ttamu.tampilkan');

    // Rute untuk Logout
    Route::get('/logout', [Clogin::class, 'logout'])->name('logout');
});