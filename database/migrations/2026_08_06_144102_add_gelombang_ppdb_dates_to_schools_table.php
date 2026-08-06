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
            $table->date('gelombang_1_start')->nullable()->after('is_ppdb');
            $table->date('gelombang_1_end')->nullable()->after('gelombang_1_start');
            $table->date('gelombang_2_start')->nullable()->after('gelombang_1_end');
            $table->date('gelombang_2_end')->nullable()->after('gelombang_2_start');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['gelombang_1_start', 'gelombang_1_end', 'gelombang_2_start', 'gelombang_2_end']);
        });
    }
};
