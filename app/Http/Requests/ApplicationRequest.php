<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:5120',
            'portofolio' => 'required|string|max:255',
            'work_id' => 'required|uuid|exists:works,id',
        ];

        // Make CV required only on create
        if ($this->isMethod('POST')) {
            $rules['cv'] = 'required|file|mimes:pdf|max:5120';
        }

        return $rules;
    }
}
