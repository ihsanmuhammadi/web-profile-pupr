<?php

namespace App\Services;

use App\Models\DataProgram;
use App\Models\Category;

class DataProgramService
{
    public function getAll($perPage = 10)
    {
        $perPage = in_array($perPage, [10, 25, 50]) ? $perPage : 10;
        return DataProgram::latest()->paginate($perPage);
    }

    public function find($id)
    {
        return DataProgram::findOrFail($id);
    }

    public function create(array $data)
    {
        return DataProgram::create($data);
    }

    public function update(DataProgram $dataProgram, array $data)
    {
        $dataProgram->update($data);
        return $dataProgram;
    }

    public function delete(DataProgram $dataProgram)
    {
        $dataProgram->delete();
    }

    public function getCategories()
    {
        return Category::select('id', 'name')->get();
    }
}
