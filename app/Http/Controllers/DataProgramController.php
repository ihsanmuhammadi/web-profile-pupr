<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataProgramRequest;
use App\Models\DataProgram;
use App\Services\DataProgramService;

class DataProgramController extends Controller
{
    protected $service;

    public function __construct(DataProgramService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $dataPrograms = $this->service->getAll();
        return view('dummyviews.dataPrograms.index', compact('dataPrograms'));
    }

    public function create()
    {
        $categories = $this->service->getCategories();
        return view('dummyviews.dataPrograms.create', compact('categories'));
    }

    public function store(DataProgramRequest $request)
    {
        $validated = $request->validated();

        // Handle dokumentasi uploads
        if ($request->hasFile('dokumentasi')) {
            $paths = [];
            foreach ($request->file('dokumentasi') as $file) {
                $paths[] = $file->store('dokumentasi', 'public'); // saves to storage/app/public/dokumentasi
            }
            $validated['dokumentasi'] = $paths;
        }

        $this->service->create($validated);

        return redirect()->route('data-programs.index')->with('success', 'Data Program created successfully.');
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
