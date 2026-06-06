<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'level',
    'description',
    'address',
    'phone',
    'email',
    'principal_name',
    'vision',
    'mission',
    'accreditation',
    'logo_path',
    'is_ppdb',
])]

class School extends Model
{
    protected function casts(): array
    {
        return [
            'is_ppdb' => 'boolean',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(news::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(activities::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(achievements::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(galleries::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(registrations::class);
    }

    public function academicCalendars(): HasMany
    {
        return $this->hasMany(academic_calendars::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(announcements::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(downloads::class);
    }

    public function rpps(): HasMany
    {
        return $this->hasMany(rpps::class);
    }
}
