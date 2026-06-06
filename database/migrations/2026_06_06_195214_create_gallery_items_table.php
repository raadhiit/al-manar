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
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')
                ->constrained('galleries')
                ->cascadeOnDelete();
            $table->string('path')->nullable();
            $table->enum('type', ['photo', 'video']);
            $table->string('youtube_url')->nullable();
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['gallery_id', 'order']);
            $table->index(['gallery_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
