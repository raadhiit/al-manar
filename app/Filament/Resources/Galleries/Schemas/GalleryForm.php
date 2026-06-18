<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Models\School;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                Select::make('type')
                    ->label('Tipe Galeri')
                    ->options([
                        'photo' => 'Foto',
                        'video' => 'Video',
                    ])
                    ->required()
                    ->live(),

                TextInput::make('title')
                    ->label('Judul Album')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('cover_path')
                    ->label('Foto Cover')
                    ->image()
                    ->disk('public')
                    ->directory('galleries/covers')
                    ->imageEditor()
                    ->maxSize(5120)
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),

                Repeater::make('items')
                    ->label('Item Galeri')
                    ->relationship()
                    ->schema([
                        Select::make('type')
                            ->label('Tipe Item')
                            ->options([
                                'photo' => 'Foto',
                                'video' => 'Video (YouTube)',
                            ])
                            ->required()
                            ->live()
                            ->default('photo'),

                        FileUpload::make('path')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('galleries/items')
                            ->maxSize(5120)
                            ->hidden(fn(Get $get) => $get('type') === 'video')
                            ->requiredUnless('type', 'video'),

                        TextInput::make('youtube_url')
                            ->label('URL YouTube')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->hidden(fn(Get $get) => $get('type') !== 'video')
                            ->requiredIf('type', 'video'),

                        TextInput::make('caption')
                            ->label('Keterangan')
                            ->maxLength(255),

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
