<?php

namespace App\Filament\Resources\CalendarEvents\Schemas;

use App\Models\School;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CalendarEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('event_date')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->native(false),

                DatePicker::make('event_end_date')
                    ->label('Tanggal Selesai (opsional)')
                    ->helperText('Isi kalau agenda berlangsung beberapa hari, mis. UTS 1–5 September — cukup isi sekali, otomatis muncul di tiap tanggal dalam rentang itu.')
                    ->native(false)
                    ->afterOrEqual('event_date'),

                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->placeholder('Semua Unit (SDIT & KB-RA)')
                    ->helperText('Kosongkan jika agenda berlaku untuk semua unit, mis. libur nasional atau rapat yayasan.'),

                TextInput::make('title')
                    ->label('Judul Agenda')
                    ->required()
                    ->placeholder('Contoh: MPLS Tahun Ajaran 2027/2028')
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('attachment_path')
                    ->label('Lampiran (opsional)')
                    ->helperText('PDF atau gambar, mis. poster/undangan kegiatan.')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->disk('public')
                    ->directory('calendar-events')
                    ->maxSize(5120)
                    ->storeFileNamesIn('original_filename')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
