<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('ruang');
            $table->string('jenis_laporan');
            $table->string('dosen_pembimbing_1');
            $table->string('dosen_pembimbing_2');
            $table->string('dosen_penguji');
            $table->string('dokumen');
            $table->date('tgl_seminar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
