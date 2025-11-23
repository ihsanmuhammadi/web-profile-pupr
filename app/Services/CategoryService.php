<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll($perPage = 10, $search = null)
    {
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;

        $query = Category::query();

        if ($search) {
            $query->where('name', 'ILIKE', "%$search%");
        }

        return $query
        ->orderBy('created_at', 'asc')
        ->paginate($perPage)
        ->appends([
            'search' => $search,
            'per_page' => $perPage,
        ]);
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category)
    {
        // Cek apakah kategori sedang dipakai oleh data program
        if ($category->dataPrograms()->exists()) {
            throw new \Exception("Kategori tidak dapat dihapus karena masih digunakan oleh data program");
        }

        // Jika lolos pengecekan, baru delete
        $category->delete();
    }

}
