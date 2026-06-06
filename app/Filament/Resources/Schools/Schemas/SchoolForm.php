<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated dari nama. Jangan diubah manual kecuali perlu.'),

                Select::make('level')
                    ->options([
                        'sdit' => 'SDIT (Sekolah Dasar Islam Terpadu)',
                        'tkit' => 'TKIT (Taman Kanak-kanak Islam Terpadu)',
                    ])
                    ->required(),

                TextInput::make('principal_name')
                    ->label('Nama Kepala Sekolah'),

                TextInput::make('accreditation')
                    ->label('Akreditasi')
                    ->placeholder('Contoh: A'),

                Toggle::make('is_ppdb')
                    ->label('Buka Pendaftaran (PPDB)')
                    ->helperText('Aktifkan untuk membuka form pendaftaran online.')
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->columnSpanFull(),

                RichEditor::make('vision')
                    ->label('Visi')
                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                    ->columnSpanFull(),

                RichEditor::make('mission')
                    ->label('Misi')
                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                    ->columnSpanFull(),

                TextInput::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel(),

                TextInput::make('email')
                    ->label('Email Sekolah')
                    ->email(),

                FileUpload::make('logo_path')
                    ->label('Logo Sekolah')
                    ->image()
                    ->disk('public')
                    ->directory('schools/logos')
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }
}
