<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Register as BaseRegister;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;

class Register extends BaseRegister {

    public function form(Form $form): Form {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getUsernameFormComponent(),
                $this->getContactFormComponent(),
                $this->getAddressFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getRoleFormComponent(),
            ])
        ->statePath('data');
    }

    protected function getUsernameFormComponent(): Component {
        return TextInput::make('username')
        ->required();
    }

    protected function getContactFormComponent(): Component {
        return TextInput::make('contact')
        ->numeric()
        ->Length(11)
        ->unique(ignoreRecord : true)
        ->required();
    }

    protected function getRoleFormComponent(): Component {
        return TextInput::make('role')
        ->default('Customer')
        ->disabled()
        ->dehydrated()
        ->required();
    }

    protected function getAddressFormComponent(): Component {
        return TextInput::make('address')
        ->required();
    }

}