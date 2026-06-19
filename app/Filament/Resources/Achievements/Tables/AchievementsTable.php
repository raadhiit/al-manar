<?php

namespace App\Filament\Resources\Achievements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                TextColumn::make('title')
                    ->label('Prestasi')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('student_name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('school.name')
                    ->label('Jenjang')
                    ->sortable()
                    ->badge(),

                TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'internasional' => 'danger',
                        'nasional'      => 'warning',
                        'provinsi'      => 'info',
                        default         => 'gray',
                    }),

                TextColumn::make('rank')
                    ->label('Peringkat'),

                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Jenjang')
                    ->relationship('school', 'name'),

                SelectFilter::make('level')
                    ->label('Tingkat')
                    ->options([
                        'sekolah'       => 'Sekolah',
                        'kecamatan'     => 'Kecamatan',
                        'kota'          => 'Kota/Kabupaten',
                        'provinsi'      => 'Provinsi',
                        'nasional'      => 'Nasional',
                        'internasional' => 'Internasional',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('year', 'desc');
    }
}
