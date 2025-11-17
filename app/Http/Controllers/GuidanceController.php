<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidanceRequest;
use App\Models\Guidance;
use App\Services\GuidanceService;
use Illuminate\Support\Facades\Auth;

class GuidanceController extends Controller
{
    protected $service;

    public function __construct(GuidanceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $guidances = $this->service->getAll();
        return view('pages.admin.admin_pedoman', compact('guidances'));
    }

    public function create()
    {
        return view('dummyviews.guidances.create');
    }

    public function store(GuidanceRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('guidances.index')->with('success', 'Guidance created successfully.');
    }

    public function show(Guidance $guidance)
    {
        return view('dummyviews.guidances.show', compact('guidance'));
    }

    public function edit(Guidance $guidance)
    {
        return view('dummyviews.guidances.edit', compact('guidance'));
    }

    public function update(GuidanceRequest $request, Guidance $guidance)
    {
        $this->service->update($guidance, $request->validated());
        return redirect()->route('guidances.index')->with('success', 'Guidance updated successfully.');
    }

    public function destroy(Guidance $guidance)
    {
        $this->service->delete($guidance);
        return redirect()->route('guidances.index')->with('success', 'Guidance deleted successfully.');
    }
}
