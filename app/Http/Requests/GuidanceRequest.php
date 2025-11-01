<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuidanceRequest extends FormRequest
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
            'link' => 'required|url|max:255|starts_with:https://',
            'kategori' => 'nullable|string|max:100|regex:/^[a-zA-Z0-9\s\-]+$/',
        ];
    }
}
