<?php

namespace App\Filament\Resources\Registrations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')
                    ->label('No. Daftar')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('student_name')
                    ->label('Nama Calon Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('school.name')
                    ->label('Jenjang')
                    ->sortable()
                    ->badge(),

                TextColumn::make('gender')
                    ->label('L/P')
                    ->badge(),

                TextColumn::make('phone')
                    ->label('No. HP')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'diterima'            => 'success',
                        'ditolak'             => 'danger',
                        'perlu_revisi'        => 'warning',
                        'menunggu_verifikasi' => 'gray',
                        default               => 'gray',
                    })
                    ->formatStateUsing(fn(string $state) => match($state) {
                        'menunggu_verifikasi' => 'Menunggu',
                        'diterima'            => 'Diterima',
                        'ditolak'             => 'Ditolak',
                        'perlu_revisi'        => 'Perlu Revisi',
                        default               => $state,
                    }),

                TextColumn::make('submitted_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_id')
                    ->label('Jenjang')
                    ->relationship('school', 'name'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'diterima'            => 'Diterima',
                        'ditolak'             => 'Ditolak',
                        'perlu_revisi'        => 'Perlu Revisi',
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
            ->defaultSort('submitted_at', 'desc');
    }
}
