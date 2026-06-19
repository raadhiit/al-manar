<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE achievements MODIFY level VARCHAR(50) NOT NULL');
        DB::statement('ALTER TABLE achievements MODIFY `rank` VARCHAR(100) NULL');
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE achievements MODIFY level ENUM('lokal', 'provinsi', 'nasional', 'internasional') NOT NULL");
        DB::statement("ALTER TABLE achievements MODIFY `rank` ENUM('1', '2', '3', 'harapan', 'finalis') NULL");
    }
};
