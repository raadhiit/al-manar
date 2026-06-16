<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class RegistrationChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Tren Pendaftar (12 Bulan Terakhir)';

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $months = collect(range(11, 0))->map(fn (int $i) => now()->subMonths($i)->startOfMonth());

        $query = Registration::query();

        if ($schoolId = $this->pageFilters['school_id'] ?? null) {
            $query->where('school_id', $schoolId);
        }

        $counts = (clone $query)
            ->selectRaw("DATE_FORMAT(submitted_at, '%Y-%m') as ym, COUNT(*) as total")
            ->whereNotNull('submitted_at')
            ->where('submitted_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('ym')
            ->pluck('total', 'ym');

        $data = $months->map(fn (Carbon $month) => $counts[$month->format('Y-m')] ?? 0);

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftar',
                    'data' => $data->values(),
                    'borderColor' => '#155742',
                    'backgroundColor' => 'rgba(21, 87, 66, 0.15)',
                    'fill' => true,
                ],
            ],
            'labels' => $months->map(fn (Carbon $month) => $month->translatedFormat('M Y'))->values(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
