<?php

namespace App\Filament\Resources\SexResource\Pages;

use App\Filament\Resources\SexResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSex extends CreateRecord
{
    protected static string $resource = SexResource::class;

    /**
     * Basically Redirects to List Page
     * I like this
     * By @404Mine
     */

     protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
