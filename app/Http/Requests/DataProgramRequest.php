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
            'waktu_pelaksanaan' => 'required|date',
            'tahun_anggaran' => 'required|integer|min:2000|max:' . date('Y') + 5,
            'lokasi' => 'required|string|max:255',
            'status_proyek' => 'required|string|max:100',
            'dokumentasi' => 'required|array',
            'kategori_id' => 'required|uuid|exists:categories,id',
        ];
    }
}
