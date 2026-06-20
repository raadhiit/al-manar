<?php

namespace App\Filament\Resources\Teachers\Schemas;

use App\Models\School;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->placeholder('Contoh: Kepala Sekolah, Guru Kelas 1A'),

                Toggle::make('is_principal')
                    ->label('Kepala Sekolah')
                    ->helperText('Aktifkan jika profil ini tampil sebagai Kepala Sekolah di halaman Beranda'),

                FileUpload::make('photo_path')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->directory('teachers/photos')
                    ->imageEditor()
                    ->columnSpanFull(),

                Textarea::make('bio')
                    ->label('Bio Singkat')
                    ->rows(4)
                    ->columnSpanFull(),

                Repeater::make('education')
                    ->label('Riwayat Pendidikan')
                    ->schema([
                        TextInput::make('degree')
                            ->label('Jenjang/Gelar')
                            ->placeholder('Contoh: S1 Pendidikan Guru Sekolah Dasar')
                            ->required(),
                        TextInput::make('institution')
                            ->label('Institusi')
                            ->placeholder('Contoh: Universitas Terbuka')
                            ->required(),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Riwayat Pendidikan')
                    ->collapsible()
                    ->columnSpanFull(),

                Textarea::make('leadership_vision')
                    ->label('Visi Kepemimpinan')
                    ->helperText('Hanya relevan untuk profil Kepala Sekolah')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('display_order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('Tampilkan di Halaman Publik')
                    ->default(true),
            ]);
    }
}
