<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRequest extends FormRequest
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
            'fileExcel' => 'mimes:xlsx,xls'
        ];
    }

    public function messages()
    {
        return [
            'fileExcel.mimes' => 'Data harus berekstensi .xlsx atau .xls'
        ];
    }
}
