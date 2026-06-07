<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\School;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->required(),

                Select::make('user_id')
                    ->label('Penulis')
                    ->options(User::pluck('name', 'id'))
                    ->required()
                    ->default(fn() => Auth::id()),

                TextInput::make('title')
                    ->label('Judul')
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

                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('news/thumbnails')
                    ->imageEditor()
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('Isi Berita')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'h2',
                        'h3',
                        'link',
                        'attachFiles',
                    ])
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Terbit',
                    ])
                    ->required()
                    ->default('draft'),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Terbit')
                    ->helperText('Kosongkan jika masih draft.'),
            ]);
    }
}
