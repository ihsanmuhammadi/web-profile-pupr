<?php

namespace App\Services;

use App\Models\DataProgram;
use App\Models\Category;

class DataProgramService
{
    public function getAll($perPage = 10, $search = null)
    {
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;

        $query = DataProgram::query();

        if ($search) {
            $query->where('judul', 'ILIKE', "%$search%");
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
        return DataProgram::findOrFail($id);
    }

    public function create(array $data)
    {
        // Sanitasi link dokumentasi
        if (!empty($data['dokumentasi'])) {
            $data['dokumentasi'] = filter_var($data['dokumentasi'], FILTER_SANITIZE_URL);
        }

        // Tambahkan tenaga kerja 1–5 meski tidak ada di request
        for ($i = 1; $i <= 5; $i++) {
            $data["tenaga_kerja_$i"] = $data["tenaga_kerja_$i"] ?? null;
            $data["posisi_$i"] = $data["posisi_$i"] ?? null;
        }

        return DataProgram::create($data);
    }

    public function update(DataProgram $dataProgram, array $data)
    {
        // Sanitasi link dokumentasi (konsisten dengan create)
        if (!empty($data['dokumentasi'])) {
            $data['dokumentasi'] = filter_var($data['dokumentasi'], FILTER_SANITIZE_URL);
        }

        // Tambahkan logika HAPUS jika input tenaga kerja tidak ada pada request
        for ($i = 1; $i <= 5; $i++) {
            if (!array_key_exists("tenaga_kerja_$i", $data)) {
                // Data tidak dikirim → user remove → hapus dari database
                $data["tenaga_kerja_$i"] = null;
            }

            if (!array_key_exists("posisi_$i", $data)) {
                $data["posisi_$i"] = null;
            }
        }

        // Update semua field
        $dataProgram->update($data);

        return $dataProgram;
    }


    public function delete(DataProgram $dataProgram)
    {
         // Cek apakah kategori sedang dipakai oleh data program
        if ($dataProgram->work()->exists()) {
            throw new \Exception("Data Program tidak dapat dihapus karena masih digunakan oleh Peluang Kerja & Magang");
        }

        $dataProgram->delete();
    }

    public function getCategories()
    {
        return Category::select('id', 'name')->get();
    }
}
