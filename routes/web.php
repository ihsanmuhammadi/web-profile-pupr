<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuidanceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataProgramController;
use App\Http\Controllers\WorkController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/visi-misi', [PageController::class, 'visiMisi'])->name('visi.misi');
Route::get('/struktur-dinas', [PageController::class, 'strukturDinas'])->name('struktur.dinas');
Route::get('/struktur-bidang', [PageController::class, 'strukturBidang'])->name('struktur.bidang');
Route::get('/pedoman-teknis', [PageController::class, 'pedomanTeknis'])->name('pedoman.teknis');
Route::get('/pedoman-daerah', [PageController::class, 'pedomanDaerah'])->name('pedoman.daerah');
Route::get('/jalan-lingkungan', [PageController::class, 'jalanLingkungan'])->name('jalan.lingkungan');
Route::get('/drainase-lingkungan', [PageController::class, 'drainaseLingkungan'])->name('drainase.lingkungan');
Route::get('/jembatan-lingkungan', [PageController::class, 'jembatanLingkungan'])->name('jembatan.lingkungan');
Route::get('/rumah-taklayak', [PageController::class, 'rumahTaklayak'])->name('rumah.taklayak');
Route::get('/perumahan', [PageController::class, 'perumahan'])->name('perumahan');
Route::get('/program/detail', [PageController::class, 'detailProgram'])->name('program.detail');
Route::get('/aduan', [PageController::class, 'aduan'])->name('aduan');
Route::get('/feedback', [PageController::class, 'feedback'])->name('feedback');
Route::get('/kerja-magang', [PageController::class, 'kerjaMagang'])->name('kerja.magang');

// ADMIN
Route::get('/admin/admin-berita', [AdminController::class, 'adminBerita'])->name('admin.berita');
Route::get('/admin/admin-aduan', [AdminController::class, 'adminAduan'])->name('admin.aduan');
Route::get('/admin/admin-dataprogram', [AdminController::class, 'adminDataprogram'])->name('admin.dataprogram');
Route::get('/admin/admin-kategori', [AdminController::class, 'adminKategori'])->name('admin.kategori');
Route::get('/admin/admin-lamaran', [AdminController::class, 'adminLamaran'])->name('admin.lamaran');
Route::get('/admin/admin-pedoman', [AdminController::class, 'adminPedoman'])->name('admin.pedoman');
Route::get('/admin/admin-peluang-kerja', [AdminController::class, 'adminPeluangKerja'])->name('admin.peluang.kerja');

Route::get('/admin/admin-login', [AdminController::class, 'adminLogin'])->name('admin.login');

// Backend
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('guidances', GuidanceController::class);
    Route::resource('news', NewsController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('data-programs', DataProgramController::class);
    Route::resource('works', WorkController::class);
});

require __DIR__.'/auth.php';
