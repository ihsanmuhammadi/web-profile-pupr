<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\NewsService;

class NewsController extends Controller
{
    protected $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $news = $this->service->getAll();
        return view('pages.admin.admin_berita', compact('news'));
    }

    public function create()
    {
        return view('dummyviews.news.create');
    }

    public function store(NewsRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('news.index')->with('success', 'News created successfully.');
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
        $this->service->update($news, $request->validated());
        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $this->service->delete($news);
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
