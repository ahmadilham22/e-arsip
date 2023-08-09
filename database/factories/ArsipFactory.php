<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arsip>
 */
class ArsipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $judul = $this->faker->judul;
        return [
            'judul' => fake()->name(),
            'ruang' => fake()->numberBetween(10, 65),
            'jenis_laporan' => Str::random(10),
            'dosen_pembimbing_1' => fake()->name(),
            'dosen_pembimbing_2' => fake()->name(),
            'dosen_penguji' => fake()->name(),
            'dokumen' => Str::random(10),
            'tgl_seminar' => now(),
        ];
    }
}
