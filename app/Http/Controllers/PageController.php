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
        return view('pages.jalan_lingkungan');
    }
    public function drainaseLingkungan()
    {
        return view('pages.drainase_lingkungan');
    }
    public function jembatanLingkungan()
    {
        return view('pages.jembatan_lingkungan');
    }
    public function rumahTaklayak()
    {
        return view('pages.rumah_taklayak');
    }
    public function perumahan()
    {
        return view('pages.perumahan');
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
