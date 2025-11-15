<?php

namespace App\Services;

use App\Models\Work;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

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
        // Handle CV file upload
        if (request()->hasFile('cv')) {
            $data['cv'] = request()->file('cv')->store('cvs', 'public');
        }
        return Application::create($data);
    }

    public function update(Application $application, array $data)
    {
        // Handle CV file upload
        if (request()->hasFile('cv')) {
            // Delete old CV if exists
            if ($application->cv && Storage::disk('public')->exists($application->cv)) {
                Storage::disk('public')->delete($application->cv);
            }

            $data['cv'] = request()->file('cv')->store('cvs', 'public');
        }
        $application->update($data);
        return $application;
    }

    public function delete(Application $application)
    {
        if ($application->cv && Storage::disk('public')->exists($application->cv)) {
            Storage::disk('public')->delete($application->cv);
        }
        $application->delete();
    }

    public function getWork()
    {
        return Work::select('id', 'posisi')->get();
    }
}
