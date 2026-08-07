<?php

namespace App\Filament\Resources\Consultations\Schemas;

use App\Models\School;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ConsultationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('parent_name')
                    ->label('Nama Orang Tua/Wali')
                    ->required(),

                TextInput::make('whatsapp')
                    ->label('Nomor WhatsApp')
                    ->tel()
                    ->required(),

                TextInput::make('child_info')
                    ->label('Usia / Kelas Anak'),

                TextInput::make('domicile')
                    ->label('Domisili'),

                Select::make('school_id')
                    ->label('Unit Diminati')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                Select::make('interest_type')
                    ->label('Jenis Permintaan')
                    ->options([
                        'brosur' => 'Minta Brosur',
                        'konsultasi' => 'Konsultasi',
                        'kunjungan' => 'Jadwalkan Kunjungan',
                    ])
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'baru' => 'Baru',
                        'dihubungi' => 'Sudah Dihubungi',
                        'selesai' => 'Selesai',
                    ])
                    ->default('baru')
                    ->required(),
            ])
            ->columns(2);
    }
}
