<?php

namespace App\Filament\Resources\Announcements\Schemas;

use App\Models\School;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnnouncementForm
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
                        'ujian'  => 'Ujian',
                        'libur'  => 'Libur',
                        'rapor'  => 'Rapor',
                        'umum'   => 'Umum',
                    ])
                    ->default('umum')
                    ->required(),

                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('Isi Pengumuman')
                    ->required()
                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link'])
                    ->columnSpanFull(),

                FileUpload::make('attachment_path')
                    ->label('Lampiran')
                    ->helperText('Opsional. Dokumen pendukung pengumuman, misal surat resmi atau jadwal.')
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
                    ->directory('announcements')
                    ->maxSize(10240)
                    ->storeFileNamesIn('attachment_filename')
                    ->columnSpanFull(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Terbit',
                    ])
                    ->default('draft')
                    ->required(),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Terbit')
                    ->helperText('Kosongkan jika masih draft.'),
            ]);
    }
}
