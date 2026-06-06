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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->date('activity_date');
            $table->text('description')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'activity_date']);
            $table->index(['school_id', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
