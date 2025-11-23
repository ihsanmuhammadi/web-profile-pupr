<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataProgramRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'tahun_anggaran' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'kecamatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'status_proyek' => 'required|string|max:100',
            'dokumentasi' => 'required|string|max:255',
            'tenaga_kerja_1' => 'nullable|string|max:255',
            'posisi_1' => 'nullable|string|max:255',
            'tenaga_kerja_2' => 'nullable|string|max:255',
            'posisi_2' => 'nullable|string|max:255',
            'tenaga_kerja_3' => 'nullable|string|max:255',
            'posisi_3' => 'nullable|string|max:255',
            'tenaga_kerja_4' => 'nullable|string|max:255',
            'posisi_4' => 'nullable|string|max:255',
            'tenaga_kerja_5' => 'nullable|string|max:255',
            'posisi_5' => 'nullable|string|max:255',
            'kategori_id' => 'required|uuid|exists:categories,id',
        ];
    }
}
