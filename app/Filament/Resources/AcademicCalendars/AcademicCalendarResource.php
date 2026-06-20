<?php

namespace App\Filament\Resources\AcademicCalendars;

use App\Filament\Resources\AcademicCalendars\Pages\CreateAcademicCalendar;
use App\Filament\Resources\AcademicCalendars\Pages\EditAcademicCalendar;
use App\Filament\Resources\AcademicCalendars\Pages\ListAcademicCalendars;
use App\Filament\Resources\AcademicCalendars\Schemas\AcademicCalendarForm;
use App\Filament\Resources\AcademicCalendars\Tables\AcademicCalendarsTable;
use App\Models\AcademicCalendar;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use App\Models\User;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AcademicCalendarResource extends Resource
{
    protected static ?string $model = AcademicCalendar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static string|UnitEnum|null $navigationGroup = 'Konten Publik';

    protected static ?string $navigationLabel = 'Kalender Pendidikan';

    protected static ?string $pluralModelLabel = 'Kalender Pendidikan';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AcademicCalendarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicCalendarsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user instanceof User && $user->hasRole(['operator_sdit', 'operator_tkit'])) {
            return $query->where('school_id', $user->school_id);
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
            'index'  => ListAcademicCalendars::route('/'),
            'create' => CreateAcademicCalendar::route('/create'),
            'edit'   => EditAcademicCalendar::route('/{record}/edit'),
        ];
    }
}
