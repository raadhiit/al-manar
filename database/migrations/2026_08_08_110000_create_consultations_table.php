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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();
            $table->string('parent_name');
            $table->string('whatsapp');
            $table->string('child_info')->nullable();
            $table->string('domicile')->nullable();
            $table->enum('interest_type', ['brosur', 'konsultasi', 'kunjungan'])->default('konsultasi');
            $table->enum('status', ['baru', 'dihubungi', 'selesai'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
