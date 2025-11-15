<?php

namespace App\Services;

use App\Models\News;

class NewsService
{
    public function getAll()
    {
        return News::latest()->get();
    }

    public function find($id)
    {
        return News::findOrFail($id);
    }

    public function create(array $data)
    {
        if (request()->hasFile('gambar')) {
            $data['gambar'] = request()->file('gambar')->store('news_images', 'public');
        }
        return News::create($data);
    }

    public function update(News $news, array $data)
    {
        if (request()->hasFile('gambar')) {
            // Delete old image if exists
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }

            $data['gambar'] = request()->file('gambar')->store('news_images', 'public');
        }
        $news->update($data);
        return $news;
    }

    public function delete(News $news)
    {
        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }
        $news->delete();
    }
}
