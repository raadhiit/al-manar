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
        ]);

        School::create([
            'name' => 'KB - Raudhatul Athfal',
            'slug' => 'kelompok-bermain-raudhatul-athfal',
            'level' => 'tkit',
            'principal_name' => null,
            'is_ppdb' => true,
        ]);
    }
}
