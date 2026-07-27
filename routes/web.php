<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\RppDownloadController;
use App\Livewire\Guru\LoginForm;
use App\Livewire\Guru\RppManager;
use Illuminate\Support\Facades\Auth;

/* ── Halaman Umum ──────────────────────────────────────────────────── */
Route::get('/',         [PublicController::class, 'home'])->name('home');
Route::get('/berita',   [PublicController::class, 'beritaIndex'])->name('berita.index');
Route::get('/berita/{slug}', [PublicController::class, 'beritaShow'])->name('berita.show');
Route::get('/prestasi', [PublicController::class, 'prestasiIndex'])->name('prestasi.index');
Route::get('/galeri',   [PublicController::class, 'galeriIndex'])->name('galeri.index');
Route::get('/tenaga-pendidik', [PublicController::class, 'guruIndex'])->name('guru.index');
Route::get('/kontak',   [PublicController::class, 'kontak'])->name('kontak');

/* ── SDIT ──────────────────────────────────────────────────────────── */
Route::prefix('sdit')->name('sdit.')->group(function () {
    Route::get('/',            [PublicController::class, 'sditIndex'])->name('index');
    Route::get('/mdta',        [PublicController::class, 'sditMdta'])->name('mdta');
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

Route::prefix('guru-rpp')->name('guru-rpp.')->group(function() {
    Route::get('/login', LoginForm::class)->middleware('guest')->name('login');
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('guru-rpp.login');
    })->middleware('auth')->name('logout');

    Route::middleware(['auth', 'role:guru'])->group(function () {
        Route::get('/', RppManager::class)->name('index');
        Route::get('/{rpp}/download', [RppDownloadController::class, 'download'])->name('download');
    });

});
