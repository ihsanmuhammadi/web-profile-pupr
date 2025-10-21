<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;

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
        return view('dummyviews.news.index', compact('news'));
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

    public function edit(News $news)
    {
        return view('dummyviews.news.edit', compact('news'));
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
