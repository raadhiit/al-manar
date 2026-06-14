<?php

namespace App\Filament\Resources\Schools\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
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

                FileUpload::make('hero_photos')
                    ->label('Foto Hero (Slider Beranda)')
                    ->helperText('Upload 3–5 foto landscape. Ditampilkan sebagai slider di halaman beranda.')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->disk('public')
                    ->directory('schools/hero')
                    ->imageEditor()
                    ->maxFiles(8)
                    ->columnSpanFull(),

                Repeater::make('fasilitas')
                    ->label('Fasilitas Sekolah')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->placeholder('Contoh: Lab Komputer')
                            ->columnSpan(2),
                        FileUpload::make('foto')
                            ->label('Foto Fasilitas')
                            ->image()
                            ->disk('public')
                            ->directory('schools/fasilitas')
                            ->imageEditor()
                            ->columnSpan(2),
                        TextInput::make('icon')
                            ->label('Emoji (opsional, muncul jika tidak ada foto)')
                            ->placeholder('Contoh: 🖥️')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Fasilitas')
                    ->collapsible()
                    ->columnSpanFull(),

                Repeater::make('eskul')
                    ->label('Ekstrakurikuler')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Eskul')
                            ->required()
                            ->placeholder('Contoh: Pramuka'),
                        TextInput::make('kategori')
                            ->label('Kategori')
                            ->placeholder('Contoh: Kepanduan, Olahraga, Seni, Akademik'),
                    ])
                    ->columns(2)
                    ->addActionLabel('Tambah Eskul')
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
