<?php

namespace App\Services;

use App\Models\DataProgram;
use App\Models\Work;

class WorkService
{
    public function getAll($perPage = 10)
    {
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;
        return Work::latest()->paginate($perPage);
    }

    public function find($id)
    {
        return Work::findOrFail($id);
    }

    public function create(array $data)
    {
        return Work::create($data);
    }

    public function update(Work $work, array $data)
    {
        $work->update($data);
        return $work;
    }

    public function delete(Work $work)
    {
        $work->delete();
    }

    public function getDataProgram()
    {
        return DataProgram::select('id', 'judul')->get();
    }
}
