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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();
            $table->string('parent_name');
            $table->text('quote');
            $table->string('photo_path')->nullable();
            // Default false (draft) — testimoni baru tidak otomatis tampil di
            // homepage sampai admin sengaja mempublikasikannya lewat Filament.
            $table->boolean('is_published')->default(false);
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
