<?php

namespace App\Filament\Resources\BodyTypeResource\Pages;

use App\Filament\Resources\BodyTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBodyType extends EditRecord
{
    protected static string $resource = BodyTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Basically Redirects to List Page
     * I like this
     * By @404Mine
     */

     protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
