<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

#[Fillable([
    'school_id',
    'title',
    'slug',
    'category',
    'activity_date',
    'description',
    'thumbnail_path',
    'yt_url',
])]
class Activity extends Model
{
    use SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty()->dontLogEmptyChanges();
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function photos()
    {
        return $this->hasMany(ActivityPhoto::class)->orderBy('order');
    }

    public function getYoutubeIdAttribute(): ?string
    {
        if (! $this->yt_url) {
            return null;
        }

        preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{11})/', $this->yt_url, $matches);

        return $matches[1] ?? null;
    }

    public function scopeForSchool(Builder $query, int $schoolId): Builder
    {
        return $query->where('school_id', $schoolId);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderBy('activity_date', 'desc');
    }
}
