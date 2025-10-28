<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkRequest;
use App\Models\Work;
use App\Services\WorkService;

class WorkController extends Controller
{
    protected $service;

    public function __construct(WorkService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $works = $this->service->getAll();
        return view('dummyviews.works.index', compact('works'));
    }

    public function create()
    {
        $dataProgram = $this->service->getDataProgram();
        return view('dummyviews.works.create', compact('dataProgram'));
    }

    public function store(WorkRequest $request)
    {
        $validated = $request->validated();
        $this->service->create($validated);

        return redirect()->route('works.index')->with('success', 'Work created successfully.');
    }

    public function edit(Work $work)
    {
        $dataProgram = $this->service->getDataProgram();
        return view('dummyviews.works.edit', compact('works', 'dataPrograms'));
    }

    public function update(WorkRequest $request, Work $work)
    {
        $this->service->update($work, $request->validated());
        return redirect()->route('works.index')->with('success', 'Work updated successfully.');
    }

    public function destroy(Work $work)
    {
        $this->service->delete($work);
        return redirect()->route('works.index')->with('success', 'Work deleted successfully.');
    }
}
