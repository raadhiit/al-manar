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
        Schema::table('schools', function (Blueprint $table) {
            // founded_year & alumni_destinations diisi di record SDIT (tidak ada
            // record School terpisah untuk Yayasan di sistem ini) — dipakai sebagai
            // angka tahun berdiri institusi & tujuan alumni di homepage.
            // student_count & avg_tahfizh_score per-unit (SDIT/KB-RA beda jumlah/target).
            // teacher_count sengaja TIDAK ditambah sebagai field manual — dihitung
            // langsung dari Teacher::active()->count(), sumber datanya sudah ada.
            $table->unsignedSmallInteger('founded_year')->nullable()->after('accreditation');
            $table->unsignedInteger('student_count')->nullable()->after('founded_year');
            $table->string('avg_tahfizh_score')->nullable()->after('student_count');
            $table->text('alumni_destinations')->nullable()->after('avg_tahfizh_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['founded_year', 'student_count', 'avg_tahfizh_score', 'alumni_destinations']);
        });
    }
};
