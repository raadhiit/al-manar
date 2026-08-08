<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('school.name')
                    ->label('Unit')
                    ->badge()
                    ->sortable(),

                TextColumn::make('quote')
                    ->label('Testimoni')
                    ->limit(60),

                IconColumn::make('is_published')
                    ->label('Publikasi')
                    ->boolean(),

                TextColumn::make('display_order')
                    ->label('Urutan')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Unit')
                    ->relationship('school', 'name'),

                TernaryFilter::make('is_published')
                    ->label('Status Publikasi'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('display_order');
    }
}
