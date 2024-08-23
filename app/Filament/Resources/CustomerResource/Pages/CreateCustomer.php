<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    /**
     * Basically Redirects to List Page
     * I like this
     * By @404Mine
     */

     protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
