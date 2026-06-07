<?php

namespace App\Filament\Resources\Downloads\Schemas;

use App\Models\School;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DownloadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'silabus'  => 'Silabus',
                        'modul'    => 'Modul',
                        'formulir' => 'Formulir',
                        'brosur'   => 'Brosur',
                        'lainnya'  => 'Lainnya',
                    ])
                    ->default('lainnya')
                    ->required(),

                TextInput::make('title')
                    ->label('Judul File')
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktif (tampil di portal)')
                    ->default(true),

                FileUpload::make('file_path')
                    ->label('File')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'image/jpeg',
                        'image/png',
                    ])
                    ->disk('public')
                    ->directory('downloads')
                    ->maxSize(10240)
                    ->required()
                    ->storeFileNamesIn('original_filename')
                    ->columnSpanFull(),
            ]);
    }
}
