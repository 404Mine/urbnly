<?php

namespace App\Filament\EndUser\Resources\UserOrderResource\Pages;

use App\Filament\EndUser\Resources\UserOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserOrder extends CreateRecord
{
    protected static string $resource = UserOrderResource::class;
}
