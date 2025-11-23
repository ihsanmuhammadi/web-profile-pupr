<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Services\ApplicationService;
use Exception;

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

        return redirect()->back()->with('success', true);
    }

    public function show(Application $application)
    {
        $application = Application::with('work')->findOrFail($application->id);

        return response()->json([

            'nama' => $application->nama,
            'posisi' => $application->work->posisi,
            'proyek' => $application->work->dataProgram->judul,
            'email' => $application->email,
            'nomor_telepon' => $application->nomor_telepon,
            'lokasi' => $application->lokasi,
            'pendidikan' => $application->pendidikan,
            'jurusan' => $application->jurusan,
            'cv' => $application->cv,
            'portofolio' => $application->portofolio,
        ]);
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
        try {
            $this->service->delete($application);

            return redirect()->route('admin.lamaran')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {

            return redirect()->route('admin.lamaran')
                ->with('error', 'Data gagal dihapus!');
        }
    }
}
