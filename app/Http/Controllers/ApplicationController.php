<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        $works = $this->service->getWork();
        $applications = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_lamaran', compact('applications', 'works'));
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

    public function show(Application $application)
    {
        $work = $this->service->getWork();
        return view('dummyviews.applications.show', compact('application', 'work'));
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
