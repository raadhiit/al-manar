<?php

namespace App\Filament\Resources\Rpps;

use App\Filament\Resources\Rpps\Pages\CreateRpp;
use App\Filament\Resources\Rpps\Pages\EditRpp;
use App\Filament\Resources\Rpps\Pages\ListRpps;
use App\Filament\Resources\Rpps\Schemas\RppForm;
use App\Filament\Resources\Rpps\Tables\RppsTable;
use App\Models\Rpp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RppResource extends Resource
{
    protected static ?string $model = Rpp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'RPP';

    protected static ?string $pluralModelLabel = 'RPP';

    protected static ?string $recordTitleAttribute = 'subject';

    public static function form(Schema $schema): Schema
    {
        return RppForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RppsTable::configure($table);
    }

    // Guru hanya melihat RPP milik sendiri; super_admin & operator lihat semua
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->hasRole('guru')) {
            return $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListRpps::route('/'),
            'create' => CreateRpp::route('/create'),
            'edit'   => EditRpp::route('/{record}/edit'),
        ];
    }
}
