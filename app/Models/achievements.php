<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


#[Fillable([
    'school_id',
    'title',
    'student_name',
    'level',
    'competition_name',
    'rank',
    'year',
    'photo_path',
])]
class achievements extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function scopeForSchool(Builder $query, int $schoolId): Builder
    {
        return $query->where('school_id', $schoolId);
    }

    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }

    public function scopeByYear(Builder $query, int $year): Builder
    {
        return $query->where('year', $year);
    }
}
