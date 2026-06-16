<?php

namespace App\Filament\Pages;

use App\Models\School;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        /** @var User|null $user */
        $user = Auth::user();
        $isOperator = $user?->hasRole(['operator_sdit', 'operator_tkit']) ?? false;

        return $schema->components([
            Select::make('school_id')
                ->label('Sekolah')
                ->placeholder('Semua Sekolah')
                ->options(School::pluck('name', 'id'))
                ->default($isOperator ? $user?->school_id : null)
                ->disabled($isOperator)
                ->dehydrated()
                ->live(),
        ]);
    }
}
