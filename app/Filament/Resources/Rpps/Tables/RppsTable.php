<?php

namespace App\Filament\Resources\Rpps\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RppsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('class')
                    ->label('Kelas')
                    ->searchable(),

                TextColumn::make('semester')
                    ->label('Semester')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => "Semester $state"),

                TextColumn::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('school.name')
                    ->label('Jenjang')
                    ->sortable()
                    ->badge(),

                TextColumn::make('user.name')
                    ->label('Guru')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('original_filename')
                    ->label('Nama File')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Jenjang')
                    ->relationship('school', 'name'),

                SelectFilter::make('semester')
                    ->label('Semester')
                    ->options([
                        '1' => 'Semester 1',
                        '2' => 'Semester 2',
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
