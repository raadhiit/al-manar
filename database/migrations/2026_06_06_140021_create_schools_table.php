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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('level', ['sdit', 'tkit']);
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('principal_name')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->string('accreditation')->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('is_ppdb')->default(true);
            $table->timestamps();

            $table->index('level');
            $table->index('is_ppdb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
