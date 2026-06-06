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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('student_name');
            $table->enum('level', ['lokal', 'provinsi', 'nasional', 'internasional']);
            $table->string('competition_name')->nullable();
            $table->enum('rank', ['1', '2', '3', 'harapan', 'finalis'])->nullable();
            $table->integer('year');
            $table->string('photo_path')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'year']);
            $table->index(['school_id', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
