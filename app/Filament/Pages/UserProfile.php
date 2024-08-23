<?php

namespace App\FIlament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class UserProfile extends BaseEditProfile {

    public function form(Form $form): Form {
        return $form
        ->schema([
            TextInput::make('username')
            ->maxLength(255)
            ->required(),
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
            TextInput::make('contact')
                ->placeholder('e.g. 09456013222')
                ->numeric()
                ->Length(11)
                ->unique(ignoreRecord : true)
                ->required(),
            TextInput::make('address')
            ->maxLength(255)
            ->required(),
        ]);
    }
    
}