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
        Schema::create('rpps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();
            $table->string('subject');
            $table->string('class');
            $table->enum('semester', ['1', '2']);
            $table->string('academic_year');
            $table->string('file_path');
            $table->string('original_filename');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'user_id']);
            $table->index(['school_id', 'academic_year', 'semester']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpps');
    }
};
