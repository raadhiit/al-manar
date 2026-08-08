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
            // Null = event 1 hari (event_date saja). Diisi = event berulang di
            // setiap tanggal dari event_date s/d event_end_date (mis. UTS 1-5 Sep),
            // supaya admin isi sekali tapi muncul di beberapa tanggal di kalender.
            $table->date('event_end_date')->nullable()->after('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar_events', function (Blueprint $table) {
            $table->dropColumn('event_end_date');
        });
    }
};
