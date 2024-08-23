<?php

namespace App\Filament\EndUser\Resources\UserStoreResource\Pages;

use App\Filament\EndUser\Resources\UserStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserStores extends ListRecords
{
    protected static string $resource = UserStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
