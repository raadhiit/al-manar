<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

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
    'thumbnail_path',
    'is_ppdb',
    'gelombang_1_start',
    'gelombang_1_end',
    'gelombang_2_start',
    'gelombang_2_end',
    'tahun_ajaran_mulai',
    'fasilitas',
    'eskul',
    'hero_photos',
])]

class School extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty()->dontLogEmptyChanges();
    }

    protected function casts(): array
    {
        return [
            'is_ppdb'   => 'boolean',
            'gelombang_1_start' => 'date',
            'gelombang_1_end'   => 'date',
            'gelombang_2_start' => 'date',
            'gelombang_2_end'   => 'date',
            'tahun_ajaran_mulai' => 'integer',
            'fasilitas'   => 'array',
            'eskul'       => 'array',
            'hero_photos' => 'array',
        ];
    }

    /**
     * Label periode Gelombang I, mis. "Sep s/d Des 2026". Null jika belum diisi admin.
     */
    public function getGelombang1LabelAttribute(): ?string
    {
        return $this->formatGelombangLabel($this->gelombang_1_start, $this->gelombang_1_end);
    }

    /**
     * Label periode Gelombang II, mis. "Jan s/d Apr 2027". Null jika belum diisi admin.
     */
    public function getGelombang2LabelAttribute(): ?string
    {
        return $this->formatGelombangLabel($this->gelombang_2_start, $this->gelombang_2_end);
    }

    private function formatGelombangLabel(?\Carbon\Carbon $start, ?\Carbon\Carbon $end): ?string
    {
        if (! $start || ! $end) {
            return null;
        }

        return $start->locale('id')->isoFormat('MMM') . ' s/d ' . $end->locale('id')->isoFormat('MMM YYYY');
    }

    /**
     * Tahun mulai tahun ajaran yang sedang dibuka PPDB-nya (mis. 2027 untuk "2027/2028").
     * Jatuh balik ke tahun depan dari sekarang jika admin belum mengisinya di Filament,
     * supaya halaman tetap tampil masuk akal sebelum data PPDB tahun berjalan disetel.
     */
    public function tahunAjaranMulaiEffective(): int
    {
        return $this->tahun_ajaran_mulai ?? ((int) date('Y') + 1);
    }

    /**
     * Label tahun ajaran, mis. "2027/2028". Satu-satunya sumber untuk semua tempat
     * yang sebelumnya menghitung tahun sendiri-sendiri via date('Y') (lihat #1 di
     * Task_List_Review_Website_AL_MANAR.md — tahun ajaran & tanggal daftar ulang
     * dulu tidak konsisten karena tiap tempat pakai offset date() yang beda).
     */
    public function getTahunAjaranLabelAttribute(): string
    {
        $start = $this->tahunAjaranMulaiEffective();

        return $start . '/' . ($start + 1);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function academicCalendars(): HasMany
    {
        return $this->hasMany(AcademicCalendar::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    public function rpps(): HasMany
    {
        return $this->hasMany(Rpp::class);
    }
}
