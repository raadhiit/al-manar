<?php

namespace App\Filament\Resources\Downloads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DownloadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('school.name')
                    ->label('Jenjang')
                    ->sortable()
                    ->badge(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),

                TextColumn::make('original_filename')
                    ->label('Nama File')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Jenjang')
                    ->relationship('school', 'name'),

                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'silabus'  => 'Silabus',
                        'modul'    => 'Modul',
                        'formulir' => 'Formulir',
                        'brosur'   => 'Brosur',
                        'lainnya'  => 'Lainnya',
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
            ->defaultSort('created_at', 'desc');
    }
}
