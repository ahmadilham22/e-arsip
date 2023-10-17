<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(User $user)
    {
        return [
            'name' => 'required|string',
            'npm' => 'required|string',
            'role' => 'nullable|string|in:mahasiswa,admin',
            'angkatan' => 'numeric',
            'password' => 'string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'npm.required' => 'NPM harus diisi',
            'password.required' => 'Password harus diisi',
            'angkatan.required' => 'Angkatan harus diisi',
            'angkatan.numeric' => 'Angkatan harus dalam bentuk angka atau tahun',
            'password.min' => 'Password harus lebih dari 8 karakter',
            'password.regex' => 'Password harus terdiri dari satu huruf besar, satu huruf kecil, dan satu angka',
            'fileExcel.mimes' => 'Data harus berekstensi .xlsx atau .xls'
        ];
    }
}
