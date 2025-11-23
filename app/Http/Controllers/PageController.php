<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function visiMisi()
    {
        return view('pages.visi_misi');
    }
    public function strukturDinas()
    {
        return view('pages.struktur_dinas');
    }

    public function strukturBidang()
    {
        return view('pages.struktur_bidang');
    }

    public function pedomanTeknis()
    {
        return view('pages.pedoman_teknis');
    }
    public function pedomanDaerah()
    {
        return view('pages.pedoman_daerah');
    }
    public function jalanLingkungan()
    {
        $programs = Program::where('category_id', 1)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        $pageTitle = 'Jalan Lingkungan';
        $pageDescription = 'Deskripsi singkat lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum ipsum lorem ipsum lorem ipsum lorem ipsum.';
        $modalContent = '<p>Lorem ipsum lorem ipsum lorem ipsum...</p><h6 class="fw-bold mt-4 mb-2">Tujuan & Manfaat</h6><ul><li>lorem ipsum lorem ipsum lorem ipsum</li><li>lorem ipsum lorem ipsum lorem ipsum</li></ul>';

        return view('pages.program_list', compact('programs', 'pageTitle', 'pageDescription', 'modalContent'));
    }

    public function drainaseLingkungan()
    {
        $programs = Program::where('category_id', 2)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        $pageTitle = 'Drainase Lingkungan';
        $pageDescription = 'Deskripsi singkat program drainase lingkungan...';
        $modalContent = '<p>Informasi lengkap tentang Drainase Lingkungan...</p>';

        return view('pages.program_list', compact('programs', 'pageTitle', 'pageDescription', 'modalContent'));
    }

    public function jembatanLingkungan()
    {
        $programs = Program::where('category_id', 3)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        $pageTitle = 'Jembatan Lingkungan';
        $pageDescription = 'Deskripsi singkat program jembatan lingkungan...';
        $modalContent = '<p>Informasi lengkap tentang Jembatan Lingkungan...</p>';

        return view('pages.program_list', compact('programs', 'pageTitle', 'pageDescription', 'modalContent'));
    }

    public function rumahTaklayak()
    {
        $programs = Program::where('category_id', 4)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        $pageTitle = 'Rumah Tak Layak Huni';
        $pageDescription = 'Deskripsi singkat program rumah tak layak huni...';
        $modalContent = '<p>Informasi lengkap tentang Rumah Tak Layak Huni...</p>';

        return view('pages.program_list', compact('programs', 'pageTitle', 'pageDescription', 'modalContent'));
    }

    public function perumahan()
    {
        $programs = Program::where('category_id', 5)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        $pageTitle = 'Perumahan';
        $pageDescription = 'Deskripsi singkat program perumahan...';
        $modalContent = '<p>Informasi lengkap tentang Perumahan...</p>';

        return view('pages.program_list', compact('programs', 'pageTitle', 'pageDescription', 'modalContent'));
    }
    public function detailProgram()
    {
        return view('pages.detail_program');
    }
    public function aduan()
    {
        return view('pages.aduan');
    }
    public function feedback()
    {
        return view('pages.feedback');
    }
    public function kerjaMagang()
    {
        return view('pages.kerja_magang');
    }

}
