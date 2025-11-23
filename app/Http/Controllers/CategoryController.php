<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search  = $request->input('search');

        $categories = $this->service->getAll($perPage, $search);
        return view('pages.admin.admin_kategori', compact('categories'));
    }

    public function create()
    {
        return view('dummyviews.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->service->create($request->validated());

            return redirect()->route('admin.kategori')
                ->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {

            return redirect()->route('admin.kategori')
                ->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function show(Category $category)
    {
        $category = Category::findOrFail($category->id);

        return response()->json([

            'name' => $category->name,
            'description' => $category->description,
            'tujuan' => $category->tujuan,
            'contoh_program_1' => $category->contoh_program_1,
            'contoh_program_2' => $category->contoh_program_2,
            'contoh_program_3' => $category->contoh_program_3,
        ]);
    }

    public function edit(Category $category)
    {
        return view('dummyviews.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {

            // Reset value contoh program
            $category->contoh_program_1 = null;
            $category->contoh_program_2 = null;
            $category->contoh_program_3 = null;

            // Update field utama
            $category->name = $request->name;
            $category->description = $request->description;
            $category->tujuan = $request->tujuan;

            // Isi kembali contoh program jika ada
            foreach (range(1, 3) as $i) {
                $field = "contoh_program_" . $i;
                if ($request->has($field)) {
                    $category->$field = $request->$field;
                }
            }

            $category->save();

            return redirect()->route('admin.kategori')
                ->with('success', 'Data telah berhasil diperbarui!');
        } catch (Exception $e) {

            return redirect()->route('admin.kategori')
                ->with('error', 'Data gagal diperbarui!');
        }
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category);

            return redirect()->route('admin.kategori')
                ->with('success', 'Data telah berhasil dihapus!');
        } catch (Exception $e) {

            return redirect()->route('admin.kategori')
                ->with('error', $e->getMessage());
        }
    }
}
