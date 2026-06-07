<?php

namespace App\Filament\Resources\Rpps\Schemas;

use App\Models\School;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class RppForm
{
    public static function configure(Schema $schema): Schema
    {
        $isGuru = Auth::user()?->hasRole('guru');

        return $schema
            ->components([
                // Guru: user_id otomatis diisi, disembunyikan
                // Super admin/operator: bisa pilih guru
                $isGuru
                    ? Hidden::make('user_id')->default(Auth::id())
                    : Select::make('user_id')
                        ->label('Guru')
                        ->options(
                            User::role('guru')->pluck('name', 'id')
                        )
                        ->required(),

                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                TextInput::make('subject')
                    ->label('Mata Pelajaran')
                    ->required(),

                TextInput::make('class')
                    ->label('Kelas')
                    ->required()
                    ->placeholder('Contoh: 1A, 2B'),

                Select::make('semester')
                    ->label('Semester')
                    ->options([
                        '1' => 'Semester 1 (Ganjil)',
                        '2' => 'Semester 2 (Genap)',
                    ])
                    ->required(),

                TextInput::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->required()
                    ->placeholder('Contoh: 2025/2026'),

                FileUpload::make('file_path')
                    ->label('File RPP')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->disk('public')
                    ->directory('rpps')
                    ->maxSize(10240)
                    ->required()
                    ->storeFileNamesIn('original_filename')
                    ->columnSpanFull(),
            ]);
    }
}
