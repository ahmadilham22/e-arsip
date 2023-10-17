<?php

namespace App\Exports;

use App\Models\Arsip;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportArchive implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('archives')->select('judul', 'ruang', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_penguji', 'tgl_seminar')->get();
        return $data;
    }
}