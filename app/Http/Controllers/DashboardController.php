<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guidance;
use App\Models\Work;
use App\Models\News;
use App\Models\DataProgram;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function getHomepageData()
    {
        $total_jalan_lingkungan = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Jalan Lingkungan');
        })->count();

        $total_drainase_lingkungan = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Drainase Lingkungan');
        })->count();

        $total_jembatan_lingkungan = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Jembatan Lingkungan');
        })->count();

        $total_perumahan = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Perumahan');
        })->count();

        // count average perumahan by kecamatan column in dataprogram
        $avg_perumahan_per_kecamatan = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Perumahan');
        })
        ->selectRaw('kecamatan, COUNT(*) as total')
        ->groupBy('kecamatan')
        ->get()
        ->avg('total');

        $total_rumah_tidak_layak = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Rumah Tidak Layak Huni');
        })->count();

        // count average rumah tidak layak huni by kecamatan column in dataprogram
        $avg_rumah_tidak_layak_per_kecamatan = DataProgram::whereHas('kategori', function($query) {
            $query->where('name', 'Rumah Tidak Layak Huni');
        })
        ->selectRaw('kecamatan, COUNT(*) as total')
        ->groupBy('kecamatan')
        ->get()
        ->avg('total');

        // News
        $news = News::latest()->take(5)->get();

        return view('pages.home', [
            'total_jalan_lingkungan' => $total_jalan_lingkungan,
            'total_drainase_lingkungan' => $total_drainase_lingkungan,
            'total_jembatan_lingkungan' => $total_jembatan_lingkungan,
            'total_perumahan' => $total_perumahan,
            'avg_perumahan_per_kecamatan' => round($avg_perumahan_per_kecamatan, 2),
            'total_rumah_tidak_layak' => $total_rumah_tidak_layak,
            'avg_rumah_tidak_layak_per_kecamatan' => round($avg_rumah_tidak_layak_per_kecamatan, 2),
            'news' => $news,
        ]);
    }

    public function getAllPedoman()
    {
        return Guidance::latest()->get();
    }

    public function getAllDataProgramByCategory(Request $request, string $categoryName)
    {
        $filters = $request->only(['status_proyek', 'lokasi', 'tahun_anggaran', 'search', 'sort_by', 'sort_order']);
        $filters['category_name'] = $categoryName;

        $dataPrograms = $this->service->getAllDataProgram($filters);

        // Map category name to specific view
        $views = [
            'Jalan Lingkungan'        => 'data-programs.jalan',
            'Drainase Lingkungan'     => 'data-programs.drainase',
            'Jembatan Lingkungan'     => 'data-programs.jembatan',
            'Perumahan'               => 'data-programs.perumahan',
            'Rumah Tidak Layak Huni'  => 'data-programs.rumah',
        ];

        $view = $views[$categoryName];

        return view($view, compact('dataPrograms', 'categoryName'));
    }


    public function getAllWorks(Request $request)
    {
        $filters = $request->only(['category_id', 'kecamatan', 'tahun', 'search', 'sort_by', 'sort_order']);

        $works = $this->service->getAllWorks($filters);

        return view('pages.kerja_magang', compact('works'));
    }
}
