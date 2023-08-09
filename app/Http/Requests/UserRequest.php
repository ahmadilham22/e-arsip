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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah ada',
            'password.required' => 'Password Harus Diisi',
            'password.min' => 'Password harus lebih dari 8 karakter',
            'password.regex' => 'Password harus terdiri dari satu huruf besar, satu huruf kecil, dan satu angka',
        ];
    }
}
