<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|nullable|string',
            'tujuan' => 'required|nullable|string',
            'contoh_program_1' => 'required|nullable|string',
            'contoh_program_2' => 'required|nullable|string',
            'contoh_program_3' => 'required|nullable|string',
        ];
    }
}
