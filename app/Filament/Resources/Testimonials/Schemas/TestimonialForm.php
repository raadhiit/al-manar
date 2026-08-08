<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Models\School;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->required(),

                Select::make('school_id')
                    ->label('Unit')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                Textarea::make('quote')
                    ->label('Isi Testimoni')
                    ->helperText('Usahakan singkat, maksimal 2-3 kalimat — testimoni yang kepanjangan jarang dibaca.')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('photo_path')
                    ->label('Foto (opsional)')
                    ->helperText('Wajib ada izin dari orang tua sebelum upload foto asli.')
                    ->image()
                    ->disk('public')
                    ->directory('testimonials')
                    ->imageEditor()
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('Publikasikan ke Homepage')
                    ->helperText('Default nonaktif — testimoni baru tidak otomatis tampil ke publik sampai ditinjau dan diaktifkan di sini.')
                    ->default(false)
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
