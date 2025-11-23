<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DataProgramRequest;
use App\Models\DataProgram;
use App\Services\DataProgramService;
use Exception;

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
        $categories = $this->service->getCategories();

        $dataPrograms = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_dataprogram', compact('dataPrograms', 'categories'));
    }

    public function create()
    {
        $categories = $this->service->getCategories();
        return view('dummyviews.dataPrograms.create', compact('categories'));
    }

    public function store(DataProgramRequest $request)
    {
        try {
            $this->service->create($request->validated());

            return redirect()->route('admin.dataprogram')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {

            return redirect()->route('admin.dataprogram')
                ->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function show(DataProgram $dataProgram)
    {
        $dataProgram = DataProgram::findOrFail($dataProgram->id);

        return response()->json([

        'judul' => $dataProgram->judul,
        'kategori' => $dataProgram->kategori ? $dataProgram->kategori->name : '-',
        'sub_judul' => $dataProgram->sub_judul,
        'deskripsi' => $dataProgram->deskripsi,
        'status_proyek' => $dataProgram->status_proyek,
        'waktu_mulai' => $dataProgram->waktu_mulai,
        'waktu_selesai' => $dataProgram->waktu_selesai,
        'tahun_anggaran' => $dataProgram->tahun_anggaran,
        'kecamatan' => $dataProgram->kecamatan,
        'lokasi' => $dataProgram->lokasi,
        'dokumentasi' => $dataProgram->dokumentasi,

        // Tenaga kerja & posisi
        'tenaga_kerja_1' => $dataProgram->tenaga_kerja_1,
        'posisi_1' => $dataProgram->posisi_1,
        'tenaga_kerja_2' => $dataProgram->tenaga_kerja_2,
        'posisi_2' => $dataProgram->posisi_2,
        'tenaga_kerja_3' => $dataProgram->tenaga_kerja_3,
        'posisi_3' => $dataProgram->posisi_3,
        'tenaga_kerja_4' => $dataProgram->tenaga_kerja_4,
        'posisi_4' => $dataProgram->posisi_4,
        'tenaga_kerja_5' => $dataProgram->tenaga_kerja_5,
        'posisi_5' => $dataProgram->posisi_5,
        ]);
    }

    public function edit(DataProgram $dataProgram)
    {
        $categories = $this->service->getCategories();
        return view('dummyviews.dataPrograms.edit', compact('dataProgram', 'categories'));
    }

    public function update(DataProgramRequest $request, DataProgram $dataProgram)
    {
        try {
            $this->service->update($dataProgram, $request->validated());

            return redirect()->route('admin.dataprogram')
                ->with('success', 'Data telah berhasil diperbarui!');
        } catch (Exception $e) {

            return redirect()->route('admin.dataprogram')
                ->with('error', 'Data gagal diperbarui!');
        }
    }

    public function destroy(DataProgram $dataProgram)
    {
        try {
            $this->service->delete($dataProgram);

            return redirect()->route('admin.dataprogram')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {

            return redirect()->route('admin.dataprogram')
                ->with('error', 'Data gagal dihapus!');
        }
    }
}
