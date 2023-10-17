<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        Log::debug('Importing data:', $row);

        return new User([
            'name' => ucwords(strtolower($row[1])),
            'npm' => $row[2],
            'angkatan' => $row[3],
            'password' => Hash::make($row[4])
        ]);
    }

    public function startRow(): int
    {
        return 2; // Mulai dari baris kedua (abaikan baris pertama)
    }
}
