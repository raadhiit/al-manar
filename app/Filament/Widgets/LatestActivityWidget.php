<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ActivityLogs\Tables\ActivityLogsTable;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LatestActivityWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Aktivitas Terbaru')
            ->query(Activity::query()->latest('id')->limit(8))
            ->paginated(false)
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i'),

                TextColumn::make('causer.name')
                    ->label('Pengguna')
                    ->default('Tidak diketahui'),

                TextColumn::make('event')
                    ->label('Aktivitas')
                    ->badge()
                    ->color(fn (?string $state) => ActivityLogsTable::eventColor($state))
                    ->formatStateUsing(fn (?string $state) => ActivityLogsTable::eventOptions()[$state] ?? $state),

                TextColumn::make('subject_type')
                    ->label('Menu')
                    ->formatStateUsing(fn (?string $state) => ActivityLogsTable::menuLabel($state) ?? '-'),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(40),
            ]);
    }
}
