<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'archives';

    protected $fillable = [
        'judul',
        'user_id',
        'ruang',
        'jenis_laporan',
        'dosen_pembimbing_1',
        'dosen_pembimbing_2',
        'dosen_penguji',
        'dokumen',
        'tgl_seminar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
