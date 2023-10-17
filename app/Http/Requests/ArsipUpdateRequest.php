<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArsipUpdateRequest extends FormRequest
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
            'user_id' => 'required',
            'dosen_pembimbing_1' => 'required',
            'dosen_pembimbing_2' => 'required',
            'dosen_penguji' => 'required',
            'dokumen' => 'file|mimes:pdf',
            'tgl_seminar' => 'required',
            'berita_acara' => 'file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul harus diisi',
            'ruang.required' => 'Ruang harus diisi',
            'user_id.required' => 'Pemilik harus diisi',
            'jenis_laporan.required' => 'Jenis laporan harus diisi',
            'dosen_pembimbing_1.required' => 'Dosen pembimbing 1 harus diisi',
            'dosen_pembimbing_2.required' => 'Dosen pembimbing 2 harus diisi',
            'dosen_penguji.required' => 'Dosen pembahas harus diisi',
            // 'dokumen.required' => 'Fil harus diisi',
            'dokumen.mimes' => 'Dokumen harus merupakan file berekstensi .pdf',
            'berita_acara.mimes' => 'Dokumen harus merupakan file berekstensi .pdf',
            'tgl_seminar.required' => 'Tanggal seminar harus diisi',
        ];
    }
}
