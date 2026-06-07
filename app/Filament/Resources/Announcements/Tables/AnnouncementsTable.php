<?php

namespace App\Filament\Resources\Announcements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AnnouncementsTable
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

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'published' => 'success',
                        'draft'     => 'gray',
                        default     => 'gray',
                    }),

                TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Jenjang')
                    ->relationship('school', 'name'),

                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'ujian' => 'Ujian',
                        'libur' => 'Libur',
                        'rapor' => 'Rapor',
                        'umum'  => 'Umum',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Terbit',
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
            ->defaultSort('published_at', 'desc');
    }
}
