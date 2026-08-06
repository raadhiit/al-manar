<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'name' => 'SDIT AL MANAR',
            'slug' => 'sdit',
            'level' => 'sdit',
            'principal_name' => null,
            'is_ppdb' => true,
            'gelombang_1_start' => '2026-09-01',
            'gelombang_1_end' => '2026-12-31',
            'gelombang_2_start' => '2027-01-01',
            'gelombang_2_end' => '2027-04-30',
            'tahun_ajaran_mulai' => 2027,
        ]);

        School::create([
            'name' => 'KB - Raudhatul Athfal',
            'slug' => 'kelompok-bermain-raudhatul-athfal',
            'level' => 'tkit',
            'principal_name' => null,
            'is_ppdb' => true,
            'tahun_ajaran_mulai' => 2027,
        ]);
    }
}
