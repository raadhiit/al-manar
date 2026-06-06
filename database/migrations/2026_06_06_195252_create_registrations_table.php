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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();
            $table->string('registration_number')->unique();
            $table->string('student_name');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('gender', ['L', 'P']);
            $table->string('religion');
            $table->string('previous_school')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('parent_job')->nullable();
            $table->enum('status', [
                'menunggu_verifikasi',
                'diterima',
                'ditolak',
                'perlu_revisi',
            ])->default('menunggu_verifikasi');
            $table->text('notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'status']);
            $table->index('registration_number');
            $table->index('submitted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
