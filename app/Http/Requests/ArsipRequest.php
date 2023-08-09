<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArsipRequest extends FormRequest
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
            'judul' => 'required|string',
            'ruang' => 'required|string',
            'jenis_laporan' => 'required',
            'dosen_pembimbing_1' => 'required',
            'dosen_pembimbing_2' => 'required',
            'dosen_penguji' => 'required',
            'dokumen' => 'required|file|mimes:pdf',
            'tgl_seminar' => 'required'
        ];
    }
}
