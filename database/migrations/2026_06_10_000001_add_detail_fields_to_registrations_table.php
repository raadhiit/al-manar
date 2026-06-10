<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Data siswa tambahan
            $table->string('nik')->nullable();
            $table->string('nisn')->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->enum('citizenship', ['WNI', 'WNA'])->default('WNI');

            // Sekolah asal (prev_school = nama, tambah tipe/alamat/npsn)
            $table->string('prev_school_type')->nullable();
            $table->string('prev_school_address')->nullable();
            $table->string('prev_school_npsn')->nullable();

            // Alamat granular
            $table->string('address_street')->nullable();
            $table->string('address_rt', 10)->nullable();
            $table->string('address_rw', 10)->nullable();
            $table->string('address_kelurahan')->nullable();
            $table->string('address_kecamatan')->nullable();
            $table->string('address_kode_pos', 10)->nullable();
            $table->string('living_arrangement')->nullable();
            $table->string('transport_mode')->nullable();

            // Detail siswa
            $table->unsignedTinyInteger('sibling_order')->nullable();
            $table->unsignedTinyInteger('sibling_count')->nullable();
            $table->decimal('height', 5, 1)->nullable();
            $table->decimal('weight', 5, 1)->nullable();
            $table->string('distance_to_school')->nullable();
            $table->string('travel_time')->nullable();

            // Sosial ekonomi
            $table->string('kks_number')->nullable();
            $table->string('kps_number')->nullable();
            $table->boolean('kip_recipient')->nullable();
            $table->string('kip_number')->nullable();
            $table->string('kip_name')->nullable();
            $table->boolean('kip_card_received')->nullable();

            // Data ayah tambahan
            $table->string('father_birthplace')->nullable();
            $table->date('father_birthdate')->nullable();
            $table->string('father_education')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_income')->nullable();
            $table->string('father_phone', 20)->nullable();

            // Data ibu tambahan
            $table->string('mother_birthplace')->nullable();
            $table->date('mother_birthdate')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_income')->nullable();
            $table->string('mother_phone', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'nisn', 'birth_certificate_no', 'citizenship',
                'prev_school_type', 'prev_school_address', 'prev_school_npsn',
                'address_street', 'address_rt', 'address_rw', 'address_kelurahan',
                'address_kecamatan', 'address_kode_pos', 'living_arrangement', 'transport_mode',
                'sibling_order', 'sibling_count', 'height', 'weight',
                'distance_to_school', 'travel_time',
                'kks_number', 'kps_number', 'kip_recipient', 'kip_number', 'kip_name', 'kip_card_received',
                'father_birthplace', 'father_birthdate', 'father_education', 'father_job', 'father_income', 'father_phone',
                'mother_birthplace', 'mother_birthdate', 'mother_education', 'mother_job', 'mother_income', 'mother_phone',
            ]);
        });
    }
};
