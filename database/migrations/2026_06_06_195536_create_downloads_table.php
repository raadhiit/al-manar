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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();
            $table->string('title');
            $table->enum('category', ['silabus', 'modul', 'formulir', 'brosur', 'lainnya'])
                ->default('lainnya');
            $table->string('file_path');
            $table->string('original_filename');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['school_id', 'category']);
            $table->index(['school_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
