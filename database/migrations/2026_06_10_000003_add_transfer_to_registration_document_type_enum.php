<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE registration_documents MODIFY COLUMN `type` ENUM('kk','akte','foto','ktp','transfer') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE registration_documents MODIFY COLUMN `type` ENUM('kk','akte','foto','ktp') NOT NULL");
    }
};
