<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Models\School;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ActivityForm
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
                        'akademik'        => 'Akademik',
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        'sosial'          => 'Sosial',
                        'keagamaan'       => 'Keagamaan',
                        'olahraga'        => 'Olahraga',
                        'lainnya'         => 'Lainnya',
                    ])
                    ->required(),

                TextInput::make('title')
                    ->label('Judul Kegiatan')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn($state, callable $set) => $set('slug', Str::slug($state))
                    )
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated dari judul.')
                    ->columnSpanFull(),

                DatePicker::make('activity_date')
                    ->label('Tanggal Kegiatan')
                    ->required(),

                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('activities/thumbnails')
                    ->imageEditor()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),

                Repeater::make('photos')
                    ->label('Foto Kegiatan')
                    ->relationship()
                    ->schema([
                        FileUpload::make('path')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('activities/photos')
                            ->required(),

                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->orderColumn('order'),
            ]);
    }
}
