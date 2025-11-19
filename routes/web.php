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
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DashboardController::class, 'getHomepageData'])->name('home');
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
Route::get('/kerja-magang', [DashboardController::class, 'getAllWorks'])->name('kerja.magang');

// ADMIN
// Route::get('/admin/admin-berita', [AdminController::class, 'adminBerita'])->name('admin.berita');
Route::get('/admin/admin-berita', [NewsController::class, 'index'])->name('admin.berita');
Route::get('/admin/admin-aduan', [ComplaintController::class, 'index'])->name('admin.aduan');
Route::get('/admin/admin-dataprogram', [DataProgramController::class, 'index'])->name('admin.dataprogram');
Route::get('/admin/admin-kategori', [CategoryController::class, 'index'])->name('admin.kategori');
Route::get('/admin/admin-lamaran', [ApplicationController::class, 'index'])->name('admin.lamaran');
Route::get('/admin/admin-pedoman', [GuidanceController::class, 'index'])->name('admin.pedoman');
Route::get('/admin/admin-peluang-kerja', [WorkController::class, 'index'])->name('admin.peluang.kerja');

Route::get('/admin/admin-login', [AdminController::class, 'adminLogin'])->name('admin.login');

// Backend
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/guidances', [GuidanceController::class, 'index'])->name('guidances.index');
    Route::get('/guidances/create', [GuidanceController::class, 'create'])->name('guidances.create');
    Route::post('/guidances', [GuidanceController::class, 'store'])->name('guidances.store');
    Route::get('/guidances/{guidance}', [GuidanceController::class, 'show'])->name('guidances.show');
    Route::get('/guidances/{guidance}/edit', [GuidanceController::class, 'edit'])->name('guidances.edit');
    Route::put('/guidances/{guidance}', [GuidanceController::class, 'update'])->name('guidances.update');
    Route::delete('/guidances/{guidance}', [GuidanceController::class, 'destroy'])->name('guidances.destroy');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/data-programs', [DataProgramController::class, 'index'])->name('data-programs.index');
    Route::get('/data-programs/create', [DataProgramController::class, 'create'])->name('data-programs.create');
    Route::post('/data-programs', [DataProgramController::class, 'store'])->name('data-programs.store');
    Route::get('/data-programs/{data_program}', [DataProgramController::class, 'show'])->name('data-programs.show');
    Route::get('/data-programs/{data_program}/edit', [DataProgramController::class, 'edit'])->name('data-programs.edit');
    Route::put('/data-programs/{data_program}', [DataProgramController::class, 'update'])->name('data-programs.update');
    Route::delete('/data-programs/{data_program}', [DataProgramController::class, 'destroy'])->name('data-programs.destroy');

    Route::get('/works', [WorkController::class, 'index'])->name('works.index');
    Route::get('/works/create', [WorkController::class, 'create'])->name('works.create');
    Route::post('/works', [WorkController::class, 'store'])->name('works.store');
    Route::get('/works/{work}', [WorkController::class, 'show'])->name('works.show');
    Route::get('/works/{work}/edit', [WorkController::class, 'edit'])->name('works.edit');
    Route::put('/works/{work}', [WorkController::class, 'update'])->name('works.update');
    Route::delete('/works/{work}', [WorkController::class, 'destroy'])->name('works.destroy');

    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::get('/complaints/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');
    Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('applications/store', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});

require __DIR__.'/auth.php';
