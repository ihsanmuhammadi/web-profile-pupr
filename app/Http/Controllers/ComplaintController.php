<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintRequest;
use App\Models\Complaint;
use App\Services\ComplaintService;

class ComplaintController extends Controller
{
    protected $service;

    public function __construct(ComplaintService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $complaints = $this->service->getAll();
        return view('dummyviews.complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('dummyviews.complaints.create');
    }

    public function store(ComplaintRequest $request)
    {
        $validated = $request->validated();
        $this->service->create($validated);

        return redirect()->route('complaints.index')->with('success', 'Complaint created successfully.');
    }

    public function edit(Complaint $complaint)
    {
        return view('dummyviews.complaints.edit', compact('complaint'));
    }

    public function update(ComplaintRequest $request, Complaint $complaint)
    {
        $this->service->update($complaint, $request->validated());
        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully.');
    }

    public function destroy(Complaint $complaint)
    {
        $this->service->delete($complaint);
        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}
