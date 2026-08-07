<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kalender Pendidikan (dokumen PDF per tahun ajaran) diganti total oleh sistem
 * kalender interaktif (tabel `calendar_events`, lihat migration
 * 2026_08_07_130000_create_calendar_events_table.php). Belum pernah ada data
 * yang benar-benar terisi di sini (dikonfirmasi kosong di lokal & jadi salah satu
 * temuan Task_List_Review_Website_AL_MANAR.md #9), jadi drop langsung aman.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('academic_calendars');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('academic_year');
            $table->string('file_path');
            $table->string('original_filename')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
};
