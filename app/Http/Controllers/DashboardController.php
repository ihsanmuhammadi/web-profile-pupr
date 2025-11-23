<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guidance;
use App\Models\Work;
use App\Models\News;
use App\Models\DataProgram;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Log;
use App\Helpers\YouTubeHelper;

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
        $currentRoute = \Route::currentRouteName(); // ambil nama route aktif
        \Log::info('Current route name:', ['route' => $currentRoute]);

        if ($currentRoute === 'pedoman.daerah') {
            $categoryName = 'Pedoman Spesifikasi Daerah';
            $view = 'pages.pedoman_daerah';

        } elseif ($currentRoute === 'pedoman.teknis') {
            $categoryName = 'Pedoman Spesifikasi Teknis';
            $view = 'pages.pedoman_teknis';
        }

        $guidances = $this->service->getAllPedoman($categoryName);

        // Debug: Check if guidances exist
        \Log::info('Guidances count:', ['count' => $guidances->count()]);

        if ($guidances->isEmpty()) {
            \Log::warning('No guidances found in database');
            return view($view, [
                'guidances' => $guidances,
                'videoData' => null
            ]);
        }


        // Get first guidance with link
        $guidance = $guidances->last();

        if (!$guidance || !$guidance->link) {
            \Log::warning('No guidance or link found', [
                'guidance_exists' => !!$guidance,
                'link' => $guidance->link ?? 'null'
            ]);

            return view($view, [
                'guidances' => $guidances,
                'videoData' => null
            ]);
        }

        $youtubeLink = $guidance->link;
        \Log::info('YouTube link from database:', ['link' => $youtubeLink]);

        // Extract video ID
        $videoId = YouTubeHelper::extractVideoId($youtubeLink);

        if (!$videoId) {
            \Log::error('Failed to extract video ID', ['link' => $youtubeLink]);

            return view($view, [
                'guidances' => $guidances,
                'videoData' => null
            ]);
        }

        \Log::info('Video ID extracted:', ['video_id' => $videoId]);

        // Get metadata from YouTube API
        $videoData = YouTubeHelper::getVideoData($videoId);

        if (!$videoData) {
            \Log::error('Failed to get video data from YouTube API', ['video_id' => $videoId]);

            // Fallback: Create basic video data without API
            $videoData = [
                'videoId' => $videoId,
                'title' => 'Video YouTube',
                'channel' => '-',
                'views' => 0,
                'published_at' => now()->toISOString(),
                'original_url' => $youtubeLink,
                'api_failed' => true
            ];
        } else {
            $videoData['original_url'] = $youtubeLink;
        }

        \Log::info('Final video data:', $videoData);

        return view($view, [
            'guidances' => $guidances,
            'videoData' => $videoData
        ]);
    }

    // public function getAllDataProgramByCategory(Request $request, string $categoryName)
    // {
    //     // ADD THIS DEBUG
    //     \Log::info('Category Request', [
    //         'category' => $categoryName,
    //         'is_ajax' => $request->ajax(),
    //         'wants_json' => $request->wantsJson(),
    //         'headers' => $request->headers->all()
    //     ]);

    //     $filters = $request->only(['status_proyek', 'lokasi', 'tahun_anggaran', 'search', 'sort_by', 'sort_order']);
    //     $filters['category_name'] = $categoryName;

    //     $perPage = $request->get('per_page', 7);
    //     $dataPrograms = $this->service->getAllDataProgram($filters, $perPage);

    //     // ADD THIS DEBUG
    //     \Log::info('Data Programs', [
    //         'total' => $dataPrograms->total(),
    //         'count' => $dataPrograms->count()
    //     ]);
    //     // Handle AJAX request
    //     if ($request->ajax() || $request->wantsJson()) {
    //         return response()->json([
    //             'data' => $dataPrograms->items(),
    //             'current_page' => $dataPrograms->currentPage(),
    //             'last_page' => $dataPrograms->lastPage(),
    //             'per_page' => $dataPrograms->perPage(),
    //             'total' => $dataPrograms->total(),
    //         ]);
    //     }

    //     // Return view for normal requests
    //     $views = [
    //         'jalan-lingkungan'        => 'pages.jalan_lingkungan',
    //         'Jalan Lingkungan'        => 'pages.jalan_lingkungan',
    //         'Drainase Lingkungan'     => 'data-programs.drainase',
    //         'Jembatan Lingkungan'     => 'data-programs.jembatan',
    //         'Perumahan'               => 'data-programs.perumahan',
    //         'Rumah Tidak Layak Huni'  => 'data-programs.rumah',
    //     ];

    //     $view = $views[$categoryName] ?? 'pages.jalan_lingkungan';

    //     return view($view, compact('dataPrograms', 'categoryName'));
    // }

    public function getAllDataProgramByCategory(Request $request, string $categoryName)
    {
        \Log::info('Category Name Received', ['category' => $categoryName]);

        switch ($categoryName) {
            case 'jalan-lingkungan':
                $category = "Jalan Lingkungan";
                break;
            case 'drainase-lingkungan':
                $category = "Drainase Lingkungan";
                break;
            case 'jembatan-lingkungan':
                $category = "Jembatan Lingkungan";
                break;
            case 'perumahan':
                $category = "Perumahan";
                break;
            case 'rumah-tidak-layak-huni':
                $category = "Rumah Tidak Layak Huni";
                break;
            default:
                $category = "Jalan Lingkungan";
                break;
        }

        $filters = [
            'status_proyek'     => $request->input('status_proyek', []),
            'tahun_anggaran'    => $request->input('tahun_anggaran', []),
            'lokasi'            => $request->input('lokasi', []),
            'search'            => $request->input('search'),
            'sort_by'           => $request->input('sort_by', 'latest'),
            'category_name'     => $category,
        ];

        \Log::info('Filters Applied', $filters);

        $dataPrograms = $this->service->getAllDataProgram($filters);
        $categoryData = $this->service->findByName($category);

        // Handle AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $dataPrograms,
                'count' => $dataPrograms->count(),
                'locations_count' => $dataPrograms->pluck('lokasi')->unique()->count()
            ]);
        }

        // Return view mapping for normal requests
        $views = [
            'jalan-lingkungan'        => 'pages.jalan_lingkungan',
            'Jalan Lingkungan'        => 'pages.jalan_lingkungan',
            'Drainase Lingkungan'     => 'data-programs.drainase',
            'Jembatan Lingkungan'     => 'data-programs.jembatan',
            'Perumahan'               => 'data-programs.perumahan',
            'Rumah Tidak Layak Huni'  => 'data-programs.rumah',
        ];

        $view = $views[$categoryName] ?? 'pages.jalan_lingkungan';

        \Log::info('View Selected', ['view' => $view]);

        return view($view, compact('dataPrograms', 'categoryName', 'categoryData'));
    }


    public function getAllWorks(Request $request)
    {
        $filters = [
            'level'     => $request->input('level', []),
            'jenis'     => $request->input('jenis', []),
            'tipe'      => $request->input('tipe', []),
            'lokasi'    => $request->input('lokasi'),
            'search'    => $request->input('search'),
            'sort_by'   => $request->input('sort_by', 'latest'),
        ];

        $works = $this->service->getAllWorks($filters);

        return view('pages.kerja_magang', compact('works'));
    }
}
