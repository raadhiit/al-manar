<?php

namespace App\Filament\Resources\Schools\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SchoolsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nama Sekolah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('level')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'sdit' => 'success',
                        'tkit' => 'info',
                    }),

                TextColumn::make('principal_name')
                    ->label('Kepala Sekolah')
                    ->searchable()
                    ->default('-'),

                TextColumn::make('accreditation')
                    ->label('Akreditasi')
                    ->badge()
                    ->default('-'),

                IconColumn::make('is_ppdb')
                    ->label('PPDB Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('level')
                    ->label('Jenjang')
                    ->options([
                        'sdit' => 'SDIT',
                        'tkit' => 'TKIT',
                    ]),

                SelectFilter::make('is_ppdb')
                    ->label('Status PPDB')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
