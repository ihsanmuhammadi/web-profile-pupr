<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

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
Route::get('/admin/berita', [AdminController::class, 'berita'])->name('berita');

