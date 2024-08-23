<?php

namespace App\Filament\EndUser\Resources\UserStoreResource\Pages;

use App\Filament\EndUser\Resources\UserStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserStore extends EditRecord
{
    protected static string $resource = UserStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
