<?php

namespace App\Filament\Resources\BodyTypeResource\Pages;

use App\Filament\Resources\BodyTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBodyType extends CreateRecord
{
    protected static string $resource = BodyTypeResource::class;

    /**
     * Basically Redirects to List Page
     * I like this
     * By @404Mine
     */

     protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
