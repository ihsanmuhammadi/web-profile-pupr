<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DataProgramRequest;
use App\Models\DataProgram;
use App\Models\Work;
use App\Services\DataProgramService;
use App\Helpers\YouTubeHelper;

class DataProgramController extends Controller
{
    protected $service;

    public function __construct(DataProgramService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        $dataPrograms = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_dataprogram', compact('dataPrograms'));
    }

    public function create()
    {
        $categories = $this->service->getCategories();
        return view('dummyviews.dataPrograms.create', compact('categories'));
    }

    public function store(DataProgramRequest $request)
    {
        $validated = $request->validated();

        $this->service->create($validated);

        return redirect()->route('data-programs.index')->with('success', 'Data Program created successfully.');
    }

    public function show($categoryName, $id)
    {
        $category = match ($categoryName) {
            'jalan-lingkungan' => 'Jalan Lingkungan',
            'drainase-lingkungan' => 'Drainase Lingkungan',
            'jembatan-lingkungan' => 'Jembatan Lingkungan',
            'perumahan' => 'Perumahan',
            'rumah-tidak-layak-huni' => 'Rumah Tidak Layak Huni',
            default => 'Jalan Lingkungan'
        };

        $dataProgram = DataProgram::findOrFail($id);

        // Hitung total work per kategori
        $totalWorkByKategori = Work::whereHas('dataProgram', function($query) use ($dataProgram) {
            $query->where('judul', $dataProgram->judul);
        })->count();

        // Convert link youtube menjadi embed
        $videoId = YouTubeHelper::extractVideoId($dataProgram->dokumentasi);
        $embedUrl = $videoId ? "https://www.youtube.com/embed/" . $videoId : null;

        return view('pages.detail_program', compact('dataProgram', 'totalWorkByKategori', 'categoryName', 'embedUrl'));
    }

    public function edit(DataProgram $dataProgram)
    {
        $categories = $this->service->getCategories();
        return view('dummyviews.dataPrograms.edit', compact('dataProgram', 'categories'));
    }

    public function update(DataProgramRequest $request, DataProgram $dataProgram)
    {
        $this->service->update($dataProgram, $request->validated());
        return redirect()->route('data-programs.index')->with('success', 'Data Program updated successfully.');
    }

    public function destroy(DataProgram $dataProgram)
    {
        $this->service->delete($dataProgram);
        return redirect()->route('data-programs.index')->with('success', 'Data Program deleted successfully.');
    }
}
