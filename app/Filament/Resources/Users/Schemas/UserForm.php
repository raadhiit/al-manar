<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\School;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn(string $operation) => $operation === 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->helperText('Kosongkan jika tidak ingin mengubah password.'),

                Select::make('school_id')
                    ->label('Jenjang')
                    ->options(School::pluck('name', 'id'))
                    ->helperText('Kosongkan untuk super_admin.'),

                Select::make('roles')
                    ->label('Role')
                    ->options(Role::pluck('name', 'name'))
                    ->required()
                    ->relationship('roles', 'name'),
            ]);
    }
}
