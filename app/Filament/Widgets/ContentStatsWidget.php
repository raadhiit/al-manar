<?php

namespace App\Filament\Widgets;

use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\News;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $schoolId = $this->pageFilters['school_id'] ?? null;

        $newsQuery = News::query()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        $achievementQuery = Achievement::query();
        $galleryQuery = Gallery::query();

        if ($schoolId) {
            $newsQuery->where('school_id', $schoolId);
            $achievementQuery->where('school_id', $schoolId);
            $galleryQuery->where('school_id', $schoolId);
        }

        return [
            Stat::make('Berita Bulan Ini', $newsQuery->count())
                ->icon('heroicon-o-newspaper')
                ->color('info'),

            Stat::make('Total Prestasi', $achievementQuery->count())
                ->icon('heroicon-o-trophy')
                ->color('warning'),

            Stat::make('Total Album Galeri', $galleryQuery->count())
                ->icon('heroicon-o-photo')
                ->color('primary'),
        ];
    }
}
