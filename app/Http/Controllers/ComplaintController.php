<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ComplaintRequest;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Exception;

class ComplaintController extends Controller
{
    protected $service;

    public function __construct(ComplaintService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        $complaints = $this->service->getAll($perPage);
        return view('pages.admin.admin_aduan', compact('complaints'));
    }

    public function create()
    {
        return view('dummyviews.complaints.create');
    }

    public function store(ComplaintRequest $request)
    {
        $validated = $request->validated();
        $this->service->create($validated);

        return redirect()->route('aduan')->with('success', 'Complaint created successfully.');
    }

    public function show(Complaint $complaint)
    {
        $complaint = Complaint::findOrFail($complaint->id);

        return response()->json([

            'nama' => $complaint->nama,
            'email' => $complaint->email,
            'pesan' => $complaint->pesan,
        ]);
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
        try {
            $this->service->delete($complaint);

            return redirect()->route('admin.aduan')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {

            return redirect()->route('admin.aduan')
                ->with('error', 'Data gagal dihapus!');
        }
    }
}
