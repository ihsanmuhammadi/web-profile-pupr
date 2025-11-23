<?php

namespace App\Services;

use App\Models\Work;
use App\Models\Application;
use App\Models\DataProgram;
use App\Models\Guidance;
use App\Models\Category;
// use Illuminate\Support\Facades\Storage;

class DashboardService
{
    public function getAllDataProgram(array $filters = [])
    {
        $query = DataProgram::with(['kategori']);

        // DEBUG: Check initial query
        \Log::info('Service: Initial Query Built');

        // Filter by category name
        if (!empty($filters['category_name'])) {
            \Log::info('Service: Filtering by category', ['category' => $filters['category_name']]);

            $query->whereHas('kategori', function($q) use ($filters) {
                $q->where('name', $filters['category_name']);
            });
        }

        // FILTER: Status (array)
        if (!empty($filters['status_proyek']) && is_array($filters['status_proyek'])) {
            \Log::info('Service: Filtering by status', ['status' => $filters['status_proyek']]);
            $query->whereIn('status_proyek', $filters['status_proyek']);
        }

        // FILTER: Tahun Anggaran (array)
        if (!empty($filters['tahun_anggaran']) && is_array($filters['tahun_anggaran'])) {
            \Log::info('Service: Filtering by year', ['years' => $filters['tahun_anggaran']]);
            $query->whereIn('tahun_anggaran', $filters['tahun_anggaran']);
        }

        // FILTER: Lokasi (array)
        if (!empty($filters['lokasi']) && is_array($filters['lokasi'])) {
            \Log::info('Service: Filtering by location', ['locations' => $filters['lokasi']]);
            $query->whereIn('lokasi', $filters['lokasi']);
        }

        // FILTER: Search
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            \Log::info('Service: Filtering by search', ['search' => $search]);

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'ILIKE', "%{$search}%");
            });
        }

        // SORTING
        if (!empty($filters['sort_by'])) {
            if ($filters['sort_by'] === 'relevant' && !empty($filters['search'])) {
                $search = trim($filters['search']);
                \Log::info('Service: Sorting by relevance', ['search' => $search]);

                $query->orderByRaw("
                    ts_rank(
                        to_tsvector('indonesian', judul || ' ' || deskripsi),
                        plainto_tsquery('indonesian', ?)
                    ) DESC
                ", [$search]);
            } elseif ($filters['sort_by'] === 'oldest') {
                \Log::info('Service: Sorting by oldest');
                $query->orderBy('created_at', 'asc');
            } else {
                \Log::info('Service: Sorting by latest');
                $query->orderBy('created_at', 'desc');
            }
        }


        // DEBUG: Check SQL query
        \Log::info('Service: SQL Query', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        // Get results
        $results = $query->get();

        // DEBUG: Check results
        \Log::info('Service: Query Results', [
            'count' => $results->count(),
            'first' => $results->first() ? $results->first()->nama : 'NULL'
        ]);

        return $results;
    }

    public function getAllWorks(array $filters = [])
    {
        $query = Work::with(['dataProgram']);

        // FILTER: Level (SMA/SMK, D3, S1, S2)
        if (!empty($filters['level']) && is_array($filters['level'])) {
            $query->whereIn('kualifikasi', $filters['level']);
        }

        // FILTER: Jenis (Full Time, Part Time, Kontrak, Magang)
        if (!empty($filters['jenis']) && is_array($filters['jenis'])) {
            $query->whereIn('jenis', $filters['jenis']);
        }

        // FILTER: Tipe (WFO, WFH, Remote)
        if (!empty($filters['tipe']) && is_array($filters['tipe'])) {
            $query->whereIn('tipe', $filters['tipe']);
        }

        // FILTER: Lokasi (LIKE)
        if (!empty($filters['lokasi'])) {
            $query->where('lokasi', 'ILIKE', '%' . $filters['lokasi'] . '%');
        }

        // FILTER: Search
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);

            $query->where(function ($q) use ($search) {
                $q->where('posisi', 'ILIKE', "%{$search}%")
                ->orWhere('deskripsi', 'ILIKE', "%{$search}%")
                ->orWhereHas('dataProgram', function ($q2) use ($search) {
                    $q2->where('judul', 'ILIKE', "%{$search}%");
                });
            });
        }

        // SORTING
        $sortDirection = ($filters['sort_by'] === 'oldest') ? 'asc' : 'desc';
        $query->orderBy('created_at', $sortDirection);

        // Paginate and append filters to pagination links
        return $query->get(); // Bukan paginate(9)
    }

    // In your service class
    public function getAllPedoman($kategori = null)
    {
        $query = Guidance::query();

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function findByName(string $name)
    {
        return Category::where('name', $name)->firstOrFail();
    }
}
