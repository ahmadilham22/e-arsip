<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'npm' => 'required|string',
            'role' => 'nullable|string|in:mahasiswa,admin',
            'angkatan' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'npm.required' => 'NPM harus diisi',
            'angkatan.required' => 'Angkatan harus diisi',
            'angkatan.numeric' => 'Angkatan harus dalam bentuk angka atau tahun',
        ];
    }
}
