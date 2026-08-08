<?php

namespace App\Filament\Resources\Consultations\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ConsultationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable(),

                TextColumn::make('school.name')
                    ->label('Unit Diminati')
                    ->badge()
                    ->sortable(),

                TextColumn::make('interest_type')
                    ->label('Permintaan')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'brosur' => 'Minta Brosur',
                        'kunjungan' => 'Kunjungan',
                        default => 'Konsultasi',
                    }),

                TextColumn::make('domicile')
                    ->label('Domisili')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'selesai' => 'success',
                        'dihubungi' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dihubungi' => 'Sudah Dihubungi',
                        'selesai' => 'Selesai',
                        default => 'Baru',
                    }),

                TextColumn::make('created_at')
                    ->label('Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Unit')
                    ->relationship('school', 'name'),

                SelectFilter::make('status')
                    ->options([
                        'baru' => 'Baru',
                        'dihubungi' => 'Sudah Dihubungi',
                        'selesai' => 'Selesai',
                    ]),
            ])
            ->recordActions([
                Action::make('chatWa')
                    ->label('Chat WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn ($record): string => 'https://wa.me/' . preg_replace('/\D/', '', preg_replace('/^0/', '62', $record->whatsapp)))
                    ->openUrlInNewTab(),
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
