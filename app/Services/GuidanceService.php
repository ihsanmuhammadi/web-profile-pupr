<?php

namespace App\Services;

use App\Models\Guidance;

class GuidanceService
{
    public function getAll($perPage = 10, $search = null)
    {
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;

        $query = Guidance::query();

        if ($search) {
            $query->where('kategori', 'ILIKE', "%$search%");
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
        return Guidance::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['link'] = filter_var($data['link'], FILTER_SANITIZE_URL);
        return Guidance::create($data);
    }

    public function update(Guidance $guidance, array $data)
    {
        $data['link'] = filter_var($data['link'], FILTER_SANITIZE_URL);
        $guidance->update($data);
        return $guidance;
    }

    public function delete(Guidance $guidance)
    {
        $guidance->delete();
    }
}
