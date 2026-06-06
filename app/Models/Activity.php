<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'school_id',
    'title',
    'slug',
    'category',
    'activity_date',
    'description',
    'thumbnail_path',
])]
class Activity extends Model
{
    use SoftDeletes;

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function photos()
    {
        return $this->hasMany(ActivityPhoto::class)->orderBy('order');
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
