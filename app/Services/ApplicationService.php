<?php

namespace App\Services;

use App\Models\Work;
use App\Models\Application;

class ApplicationService
{
    public function getAll()
    {
        return Application::latest()->get();
    }

    public function find($id)
    {
        return Application::findOrFail($id);
    }

    public function create(array $data)
    {
        return Application::create($data);
    }

    public function update(Application $application, array $data)
    {
        $application->update($data);
        return $application;
    }

    public function delete(Application $application)
    {
        $application->delete();
    }

    public function getWork()
    {
        return Work::select('id', 'posisi')->get();
    }
}
