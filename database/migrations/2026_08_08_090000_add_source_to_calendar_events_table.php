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
        Schema::table('calendar_events', function (Blueprint $table) {
            // null = diinput manual oleh admin. 'libur_nasional' = hasil sync otomatis
            // dari API Nager.Date, dipakai sebagai kunci upsert supaya sync ulang
            // tidak menduplikasi data dan tidak menimpa event manual di tanggal yang sama.
            $table->string('source')->nullable()->after('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar_events', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};
