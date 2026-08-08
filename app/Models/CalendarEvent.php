<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

#[Fillable([
    'school_id',
    'title',
    'event_date',
    'event_end_date',
    'source',
    'description',
    'attachment_path',
    'original_filename',
])]
class CalendarEvent extends Model
{
    use LogsActivity;

    public const SOURCE_NATIONAL_HOLIDAY = 'libur_nasional';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty()->dontLogEmptyChanges();
    }

    /**
     * Ambil hari libur nasional Indonesia dari API publik Nager.Date dan simpan
     * sebagai CalendarEvent (school_id null = berlaku semua unit). Di-upsert
     * berdasarkan (event_date, source) supaya sync ulang tidak menduplikasi,
     * dan tidak menyentuh event manual admin di tanggal yang sama.
     *
     * @return int jumlah hari libur yang ter-sync
     */
    public static function syncNationalHolidays(int $year): int
    {
        $response = \Illuminate\Support\Facades\Http::timeout(10)
            ->get("https://date.nager.at/api/v3/publicholidays/{$year}/ID");

        if (! $response->successful()) {
            throw new \RuntimeException('Gagal mengambil data hari libur nasional dari API.');
        }

        $holidays = $response->json();

        foreach ($holidays as $holiday) {
            static::updateOrCreate(
                [
                    'event_date' => $holiday['date'],
                    'source' => self::SOURCE_NATIONAL_HOLIDAY,
                ],
                [
                    'school_id' => null,
                    'title' => $holiday['localName'] ?? $holiday['name'],
                ]
            );
        }

        return count($holidays);
    }

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'event_end_date' => 'date',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function scopeForSchool(Builder $query, ?int $schoolId): Builder
    {
        return $query->where('school_id', $schoolId);
    }

    /**
     * Event yang rentangnya (event_date s/d event_end_date, atau cuma
     * event_date kalau tidak ada rentang) beririsan dengan bulan yang diminta.
     */
    public function scopeOverlappingMonth(Builder $query, int $year, int $month): Builder
    {
        $monthStart = \Carbon\Carbon::create($year, $month, 1)->startOfDay();
        $monthEnd = $monthStart->copy()->endOfMonth();

        return $query
            ->where('event_date', '<=', $monthEnd)
            ->where(function (Builder $q) use ($monthStart) {
                $q->where('event_end_date', '>=', $monthStart)
                    ->orWhere(function (Builder $q2) use ($monthStart) {
                        $q2->whereNull('event_end_date')->where('event_date', '>=', $monthStart);
                    });
            });
    }

    /**
     * Label tanggal untuk ditampilkan, mis. "10 Sep 2026" untuk event 1 hari,
     * atau "1–5 September 2026" / "28 Agu – 2 Sep 2026" untuk event rentang.
     */
    public function getDateRangeLabelAttribute(): string
    {
        $start = $this->event_date;
        $end = $this->event_end_date;

        if (! $end || $end->isSameDay($start)) {
            return $start->locale('id')->isoFormat('D MMM YYYY');
        }

        if ($end->isSameMonth($start) && $end->isSameYear($start)) {
            return $start->locale('id')->isoFormat('D') . '–' . $end->locale('id')->isoFormat('D MMMM YYYY');
        }

        return $start->locale('id')->isoFormat('D MMM YYYY') . ' – ' . $end->locale('id')->isoFormat('D MMM YYYY');
    }

    /**
     * Pecah koleksi event (masing-masing punya rentang event_date..event_end_date)
     * jadi map tanggal ('Y-m-d') => koleksi event yang aktif di tanggal itu, supaya
     * event rentang (mis. UTS 5 hari) muncul di tiap tanggal dalam rentangnya
     * tanpa admin perlu input satu-satu.
     *
     * @param  \Illuminate\Support\Collection<int, self>  $events
     * @return \Illuminate\Support\Collection<string, \Illuminate\Support\Collection<int, self>>
     */
    public static function expandToDailyMap(\Illuminate\Support\Collection $events): \Illuminate\Support\Collection
    {
        $map = collect();

        foreach ($events as $event) {
            $cursor = $event->event_date->copy();
            $end = ($event->event_end_date ?? $event->event_date)->copy();

            while ($cursor->lte($end)) {
                $key = $cursor->format('Y-m-d');
                $map->put($key, ($map->get($key) ?? collect())->push($event));
                $cursor->addDay();
            }
        }

        return $map;
    }
}
