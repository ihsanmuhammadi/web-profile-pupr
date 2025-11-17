<?php

namespace App\Services;

use App\Models\Work;
use App\Models\Application;
use App\Models\DataProgram;
// use Illuminate\Support\Facades\Storage;

class ApplicationService
{
    public function getAllDataProgram(array $filters = [])
    {
        $query = DataProgram::with(['category']); // Eager load relationships

        // Filter by category name
        if (!empty($filters['category_name'])) {
            $query->whereHas('category', function($q) use ($filters) {
                $q->where('name', $filters['category_name']);
            });
        }

        // Filter by status_proyek
        if (!empty($filters['status_proyek'])) {
            $query->where('status_proyek', $filters['status_proyek']);
        }

        // Filter by tahun_anggaran
        if (!empty($filters['tahun_anggaran'])) {
            $query->where('tahun_anggaran', $filters['tahun_anggaran']);
        }

        // Filter by lokasi
        if (!empty($filters['lokasi'])) {
            $query->where('lokasi', $filters['lokasi']);
        }

        // Search by name
        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('nama', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Sort
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';

        return $query->orderBy($sortBy, $sortOrder)->get();
    }

    public function getAllWorks(array $filters = [])
    {
        $query = Work::with(['DataProgram']); // Eager load relationships

        // Filter by category name
        if (!empty($filters['category_name'])) {
            $query->whereHas('category', function($q) use ($filters) {
                $q->where('name', $filters['category_name']);
            });
        }

        // Filter by category
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Filter by kecamatan
        if (!empty($filters['kecamatan'])) {
            $query->where('kecamatan', $filters['kecamatan']);
        }

        // Filter by year
        if (!empty($filters['tahun'])) {
            $query->where('tahun', $filters['tahun']);
        }

        // Filter by date range
        if (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Search
        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('nama', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Sort
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';

        return $query->orderBy($sortBy, $sortOrder)->get();
    }
}
