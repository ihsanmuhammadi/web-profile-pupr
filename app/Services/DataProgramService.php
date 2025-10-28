<?php

namespace App\Services;

use App\Models\DataProgram;
use App\Models\Category;

class DataProgramService
{
    public function getAll()
    {
        return DataProgram::latest()->get();
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
