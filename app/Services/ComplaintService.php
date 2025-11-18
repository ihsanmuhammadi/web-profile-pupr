<?php

namespace App\Services;

use App\Models\Complaint;

class ComplaintService
{
    public function getAll($perPage = 10)
    {
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;
        return Complaint::latest()->paginate($perPage);
    }

    public function find($id)
    {
        return Complaint::findOrFail($id);
    }

    public function create(array $data)
    {
        return Complaint::create($data);
    }

    public function update(Complaint $complaint, array $data)
    {
        $complaint->update($data);
        return $complaint;
    }

    public function delete(Complaint $complaint)
    {
        $complaint->delete();
    }
}
