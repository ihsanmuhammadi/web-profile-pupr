<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminBerita() {
        return view('pages.admin.admin_berita');
    }
    public function adminAduan() {
        return view('pages.admin.admin_aduan');
    }
    public function adminDataprogram() {
        return view('pages.admin.admin_dataprogram');
    }
    public function adminKategori() {
        return view('pages.admin.admin_kategori');
    }
    public function adminLamaran() {
        return view('pages.admin.admin_lamaran');
    }
    public function adminPedoman() {
        return view('pages.admin.admin_pedoman');
    }
    public function adminPeluangKerja() {
        return view('pages.admin.admin_peluang_kerja');
    }
    public function adminLogin() {
        return view('pages.admin.admin_login');
    }

}
