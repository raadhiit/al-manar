<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'school_id', 'registration_number',
    // Data siswa
    'student_name', 'nik', 'nisn', 'birth_date', 'birth_place', 'birth_certificate_no',
    'gender', 'religion', 'citizenship',
    // Sekolah asal
    'previous_school', 'prev_school_type', 'prev_school_address', 'prev_school_npsn',
    // Alamat
    'address', 'address_street', 'address_rt', 'address_rw', 'address_kelurahan',
    'address_kecamatan', 'address_kode_pos', 'living_arrangement', 'transport_mode',
    // Detail siswa
    'sibling_order', 'sibling_count', 'height', 'weight', 'distance_to_school', 'travel_time',
    // Sosial ekonomi
    'kks_number', 'kps_number', 'kip_recipient', 'kip_number', 'kip_name', 'kip_card_received',
    // Data ayah
    'father_name', 'father_birthplace', 'father_birthdate', 'father_education',
    'father_job', 'father_income', 'father_phone',
    // Data ibu
    'mother_name', 'mother_birthplace', 'mother_birthdate', 'mother_education',
    'mother_job', 'mother_income', 'mother_phone',
    // Kontak & meta
    'phone', 'email', 'parent_job', 'status', 'notes', 'submitted_at',
])]


class Registration extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'birth_date'        => 'date',
            'father_birthdate'  => 'date',
            'mother_birthdate'  => 'date',
            'kip_recipient'     => 'boolean',
            'kip_card_received' => 'boolean',
            'submitted_at'      => 'datetime',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(RegistrationDocument::class);
    }

    public function scopeForSchool(Builder $query, int $schoolId): Builder
    {
        return $query->where('school_id', $schoolId);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'menunggu_verifikasi');
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
