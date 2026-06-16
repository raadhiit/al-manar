<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RegistrationStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -1;

    protected int|string|array $columnSpan = 1;

    protected int|array|null $columns = 2;

    protected function getStats(): array
    {
        $query = Registration::query();

        if ($schoolId = $this->pageFilters['school_id'] ?? null) {
            $query->where('school_id', $schoolId);
        }

        $total    = (clone $query)->count();
        $pending  = (clone $query)->where('status', 'menunggu_verifikasi')->count();
        $accepted = (clone $query)->where('status', 'diterima')->count();
        $rejected = (clone $query)->where('status', 'ditolak')->count();

        return [
            Stat::make('Total Pendaftar', $total)
                ->icon('heroicon-o-user-group')
                ->color('primary'),

            Stat::make('Menunggu Verifikasi', $pending)
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Diterima', $accepted)
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Ditolak', $rejected)
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
