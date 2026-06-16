<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use App\Models\User;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ActivityLogsTable
{
    public static function eventOptions(): array
    {
        return [
            'created'      => 'Tambah Data',
            'updated'      => 'Ubah Data',
            'deleted'      => 'Hapus Data',
            'login'        => 'Login',
            'logout'       => 'Logout',
            'login_failed' => 'Gagal Login',
        ];
    }

    public static function eventColor(?string $event): string
    {
        return match ($event) {
            'created' => 'success',
            'updated' => 'warning',
            'deleted' => 'danger',
            'login'   => 'info',
            'logout'  => 'gray',
            'login_failed' => 'danger',
            default   => 'gray',
        };
    }

    public static function menuLabel(?string $subjectType): ?string
    {
        if (! $subjectType) {
            return null;
        }

        return match (Str::afterLast($subjectType, '\\')) {
            'News'             => 'Berita',
            'Activity'         => 'Kegiatan',
            'Achievement'      => 'Prestasi',
            'Gallery'          => 'Galeri',
            'Registration'     => 'Pendaftaran',
            'AcademicCalendar' => 'Kalender Akademik',
            'Announcement'     => 'Pengumuman',
            'Download'         => 'Download',
            'Rpp'              => 'RPP',
            'School'           => 'Sekolah',
            'User'             => 'Pengguna',
            default            => Str::afterLast($subjectType, '\\'),
        };
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal & Jam')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),

                TextColumn::make('causer.name')
                    ->label('Pengguna')
                    ->default('Tidak diketahui')
                    ->searchable(),

                TextColumn::make('event')
                    ->label('Aktivitas')
                    ->badge()
                    ->color(fn (?string $state) => self::eventColor($state))
                    ->formatStateUsing(fn (?string $state) => self::eventOptions()[$state] ?? $state),

                TextColumn::make('subject_type')
                    ->label('Menu')
                    ->formatStateUsing(fn (?string $state) => self::menuLabel($state) ?? '-'),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn (TextColumn $column) => $column->getState()),

                TextColumn::make('properties.ip')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->label('Aktivitas')
                    ->options(self::eventOptions()),

                SelectFilter::make('causer_id')
                    ->label('Pengguna')
                    ->options(fn () => User::pluck('name', 'id'))
                    ->query(function (Builder $query, array $data) {
                        if (filled($data['value'] ?? null)) {
                            $query->where('causer_type', User::class)
                                ->where('causer_id', $data['value']);
                        }
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->schema([
                        TextEntry::make('causer.name')->label('Pengguna')->default('Tidak diketahui'),
                        TextEntry::make('causer.email')->label('Email')->default('-'),
                        TextEntry::make('event')
                            ->label('Aktivitas')
                            ->badge()
                            ->color(fn (?string $state) => self::eventColor($state))
                            ->formatStateUsing(fn (?string $state) => self::eventOptions()[$state] ?? $state),
                        TextEntry::make('subject_type')
                            ->label('Menu')
                            ->formatStateUsing(fn (?string $state) => self::menuLabel($state) ?? '-'),
                        TextEntry::make('description')->label('Deskripsi'),
                        TextEntry::make('created_at')->label('Waktu')->dateTime('d M Y, H:i:s'),
                        KeyValueEntry::make('attribute_changes_new')
                            ->label('Data Setelah Diubah')
                            ->state(fn ($record) => $record->attribute_changes?->get('attributes') ?? [])
                            ->visible(fn ($record) => filled($record->attribute_changes?->get('attributes'))),
                        KeyValueEntry::make('attribute_changes_old')
                            ->label('Data Sebelum Diubah')
                            ->state(fn ($record) => $record->attribute_changes?->get('old') ?? [])
                            ->visible(fn ($record) => filled($record->attribute_changes?->get('old'))),
                        KeyValueEntry::make('properties')
                            ->label('Detail Tambahan')
                            ->state(fn ($record) => $record->properties?->toArray() ?? [])
                            ->visible(fn ($record) => filled($record->properties?->toArray())),
                    ]),
            ])
            ->toolbarActions([])
            ->defaultSort('created_at', 'desc');
    }
}
