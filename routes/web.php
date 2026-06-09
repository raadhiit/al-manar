<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/* ── Halaman Umum ──────────────────────────────────────────────────── */
Route::get('/',         [PublicController::class, 'home'])->name('home');
Route::get('/berita',   [PublicController::class, 'beritaIndex'])->name('berita.index');
Route::get('/berita/{slug}', [PublicController::class, 'beritaShow'])->name('berita.show');
Route::get('/prestasi', [PublicController::class, 'prestasiIndex'])->name('prestasi.index');
Route::get('/galeri',   [PublicController::class, 'galeriIndex'])->name('galeri.index');
Route::get('/kontak',   [PublicController::class, 'kontak'])->name('kontak');

/* ── SDIT ──────────────────────────────────────────────────────────── */
Route::prefix('sdit')->name('sdit.')->group(function () {
    Route::get('/',            [PublicController::class, 'sditIndex'])->name('index');
    Route::get('/kegiatan',    [PublicController::class, 'sditKegiatan'])->name('kegiatan');
    Route::get('/pendaftaran', [PublicController::class, 'sditPendaftaran'])->name('pendaftaran');
});

/* ── TKIT ──────────────────────────────────────────────────────────── */
Route::prefix('tk')->name('tkit.')->group(function () {
    Route::get('/',            [PublicController::class, 'tkitIndex'])->name('index');
    Route::get('/kegiatan',    [PublicController::class, 'tkitKegiatan'])->name('kegiatan');
    Route::get('/pendaftaran', [PublicController::class, 'tkitPendaftaran'])->name('pendaftaran');
});

/* ── Portal Akademik ───────────────────────────────────────────────── */
Route::prefix('portal-akademik')->name('portal.')->group(function () {
    Route::get('/kalender',    [PublicController::class, 'portalKalender'])->name('kalender');
    Route::get('/kurikulum',   [PublicController::class, 'portalKurikulum'])->name('kurikulum');
    Route::get('/pengumuman',  [PublicController::class, 'portalPengumuman'])->name('pengumuman');
    Route::get('/download',    [PublicController::class, 'portalDownload'])->name('download');
});
