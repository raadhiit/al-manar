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
            'name'           => 'SDIT AL MANAR',
            'slug'           => 'sdit',
            'level'          => 'sdit',
            'principal_name' => null,
            'is_ppdb'        => true,
        ]);

        School::create([
            'name'           => 'TKIT AL MANAR',
            'slug'           => 'tk',
            'level'          => 'tkit',
            'principal_name' => null,
            'is_ppdb'        => true,
        ]);
    }
}
