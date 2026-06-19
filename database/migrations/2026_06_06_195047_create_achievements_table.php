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
            $table->string('level', 50);
            $table->string('competition_name')->nullable();
            $table->string('rank', 100)->nullable();
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
