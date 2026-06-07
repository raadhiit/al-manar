<?php

namespace App\Filament\Resources\AcademicCalendars\Schemas;

use App\Models\School;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademicCalendarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->placeholder('Contoh: Kalender Pendidikan 2025/2026')
                    ->columnSpanFull(),

                TextInput::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->required()
                    ->placeholder('Contoh: 2025/2026'),

                Toggle::make('is_active')
                    ->label('Aktif (tampil di portal)')
                    ->default(true),

                FileUpload::make('file_path')
                    ->label('File Kalender (PDF / Gambar)')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->disk('public')
                    ->directory('academic-calendars')
                    ->maxSize(5120)
                    ->required()
                    ->storeFileNamesIn('original_filename')
                    ->columnSpanFull(),
            ]);
    }
}
