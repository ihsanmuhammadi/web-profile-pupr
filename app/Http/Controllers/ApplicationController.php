<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Services\ApplicationService;

class ApplicationController extends Controller
{
    protected $service;

    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $applications = $this->service->getAll();
        return view('dummyviews.applications.index', compact('applications'));
    }

    public function create()
    {
        $works = $this->service->getWork();
        return view('dummyviews.applications.create', compact('works'));
    }

    public function store(ApplicationRequest $request)
    {
        $validated = $request->validated();
        $this->service->create($validated);

        return redirect()->route('applications.index')->with('success', 'Application created successfully.');
    }

    public function edit(Application $application)
    {
        $work = $this->service->getWork();
        return view('dummyviews.applications.edit', compact('application', 'work'));
    }

    public function update(ApplicationRequest $request, Application $application)
    {
        $this->service->update($application, $request->validated());
        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    public function destroy(Application $application)
    {
        $this->service->delete($application);
        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
}
