<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidanceRequest;
use Illuminate\Http\Request;
use App\Models\Guidance;
use App\Services\GuidanceService;
use Exception;
use Illuminate\Support\Facades\Auth;

class GuidanceController extends Controller
{
    protected $service;

    public function __construct(GuidanceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        $guidances = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_pedoman', compact('guidances'));
    }

    public function create()
    {
        return view('dummyviews.guidances.create');
    }

    public function store(GuidanceRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.pedoman')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->route('admin.pedoman')
                ->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function show(Guidance $guidance)
    {
        $news = Guidance::findOrFail($guidance->id);

        return response()->json([

            'link' => $guidance->link,
            'kategori' => $guidance->kategori,
            'created_at' => $guidance->created_at->format('d M Y H:i'),
            'updated_at' => $guidance->updated_at->format('d M Y H:i'),
        ]);
    }

    public function edit(Guidance $guidance)
    {
        return view('dummyviews.guidances.edit', compact('guidance'));
    }

    public function update(GuidanceRequest $request, Guidance $guidance)
    {
        try {
            $this->service->update($guidance, $request->validated());
            return redirect()->route('admin.pedoman')
                ->with('success', 'Data telah berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->route('admin.pedoman')
                ->with('error', 'Data gagal diperbarui!');
        }
    }

    public function destroy(Guidance $guidance)
    {
        try {
            $this->service->delete($guidance);
            return redirect()->route('admin.pedoman')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('admin.pedoman')
                ->with('error', 'Data gagal dihapus!');
        }
    }
}
