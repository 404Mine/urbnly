<?php

namespace App\Filament\EndUser\Resources\UserOrderResource\Pages;

use App\Filament\EndUser\Resources\UserOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserOrder extends EditRecord
{
    protected static string $resource = UserOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
