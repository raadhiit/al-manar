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
        Schema::create('registration_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')
                ->constrained('registrations')
                ->cascadeOnDelete();
            $table->enum('type', ['kk', 'akte', 'foto']);
            $table->string('path');
            $table->string('original_filename');
            $table->timestamps();

            $table->index(['registration_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_documents');
    }
};
