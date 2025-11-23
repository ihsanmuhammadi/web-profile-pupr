<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\NewsService;
use Exception;

class NewsController extends Controller
{
    protected $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        $news = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_berita', compact('news'));
    }

    public function create()
    {
        return view('dummyviews.news.create');
    }

    public function store(NewsRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.berita')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->route('admin.berita')
                ->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function show(News $news)
    {
        $news = News::findOrFail($news->id);

        return response()->json([

            'judul' => $news->judul,
            'gambar' => $news->gambar ? asset('storage/' . $news->gambar) : null,
            'created_at' => $news->created_at->format('d M Y H:i'),
            'updated_at' => $news->updated_at->format('d M Y H:i'),
        ]);
    }

    public function update(NewsRequest $request, News $news)
    {
        try {
            $this->service->update($news, $request->validated());
            return redirect()->route('admin.berita')
                ->with('success', 'Data telah berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->route('admin.berita')
                ->with('error', 'Data gagal diperbarui!');
        }
    }

    public function destroy(News $news)
    {
        try {
            $this->service->delete($news);
            return redirect()->route('admin.berita')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('admin.berita')
                ->with('error', 'Data gagal dihapus!');
        }
    }
}
