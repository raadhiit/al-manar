<?php

namespace App\Filament\Resources\Achievements\Schemas;

use App\Models\School;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                Select::make('level')
                    ->label('Tingkat')
                    ->options([
                        'sekolah'       => 'Sekolah',
                        'kecamatan'     => 'Kecamatan',
                        'kota'          => 'Kota/Kabupaten',
                        'provinsi'      => 'Provinsi',
                        'nasional'      => 'Nasional',
                        'internasional' => 'Internasional',
                    ])
                    ->required(),

                TextInput::make('title')
                    ->label('Nama Prestasi')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('student_name')
                    ->label('Nama Siswa')
                    ->required(),

                TextInput::make('competition_name')
                    ->label('Nama Lomba/Kompetisi')
                    ->required(),

                TextInput::make('rank')
                    ->label('Peringkat / Penghargaan')
                    ->placeholder('Contoh: Juara 1, Finalis, Medali Emas'),

                TextInput::make('year')
                    ->label('Tahun')
                    ->numeric()
                    ->required()
                    ->default(now()->year)
                    ->minValue(2000)
                    ->maxValue(now()->year + 1),

                FileUpload::make('photo_path')
                    ->label('Foto Prestasi')
                    ->image()
                    ->disk('public')
                    ->directory('achievements/photos')
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }
}
