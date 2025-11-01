<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
            'posisi' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'gaji' => 'required|integer',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'data_program_id' => 'required|uuid|exists:data_programs,id',
        ];
    }
}
