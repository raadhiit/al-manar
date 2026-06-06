<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'school_id',
    'registration_number',
    'student_name',
    'birth_date',
    'birth_place',
    'gender',
    'religion',
    'previous_school',
    'father_name',
    'mother_name',
    'phone',
    'email',
    'address',
    'parent_job',
    'status',
    'notes',
    'submitted_at',
])]


class registrations extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'birth_date'   => 'date',
            'submitted_at' => 'datetime',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(registration_documents::class);
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
