<?php

namespace App\Filament\Resources\Rpps\Pages;

use App\Filament\Resources\Rpps\RppResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRpp extends CreateRecord
{
    protected static string $resource = RppResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
