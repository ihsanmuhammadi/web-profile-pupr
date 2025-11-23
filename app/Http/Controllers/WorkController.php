<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkRequest;
use App\Models\Work;
use App\Services\WorkService;
use Exception;

class WorkController extends Controller
{
    protected $service;

    public function __construct(WorkService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');
        $dataProgram = $this->service->getDataProgram();

        $works = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_peluang_kerja', compact('works', 'dataProgram'));
    }

    public function create()
    {
        $dataProgram = $this->service->getDataProgram();
        return view('dummyviews.works.create', compact('dataProgram'));
    }

    public function store(WorkRequest $request)
    {
        try {
            $this->service->create($request->validated());

            return redirect()->route('admin.peluang.kerja')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {

            return redirect()->route('admin.peluang.kerja')
                ->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function show(Work $work)
    {
        $work = Work::findOrFail($work->id);

        return response()->json([

            'posisi' => $work->posisi,
            'proyek' => $work->dataProgram ? $work->dataProgram->judul : '-',
            'level' => $work->level,
            'jenis' => $work->jenis,
            'tipe' => $work->tipe,
            'lokasi' => $work->lokasi,
            'gaji' => $work->gaji,
            'deskripsi' => $work->deskripsi,
            'kualifikasi' => $work->kualifikasi,
        ]);
    }

    public function edit(Work $work)
    {
        $dataPrograms = $this->service->getDataProgram();
        return view('dummyviews.works.edit', compact('work', 'dataPrograms'));
    }

    public function update(WorkRequest $request, Work $work)
    {
        try {
            $this->service->update($work, $request->validated());

            return redirect()->route('admin.peluang.kerja')
                ->with('success', 'Data telah berhasil diperbarui!');
        } catch (Exception $e) {

            return redirect()->route('admin.peluang.kerja')
                ->with('error', 'Data gagal diperbarui!');
        }
    }

    public function destroy(Work $work)
    {
        try {
            $this->service->delete($work);

            return redirect()->route('admin.peluang.kerja')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {

            return redirect()->route('admin.peluang.kerja')
                ->with('error', 'Data gagal dihapus!');
        }
    }
}
