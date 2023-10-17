<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'berita_acara',
        'status_arsip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
