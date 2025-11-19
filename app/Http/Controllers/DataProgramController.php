<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function show(DataProgram $dataProgram)
    {
        return view('dummyviews.dataPrograms.show', compact('dataProgram'));
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
