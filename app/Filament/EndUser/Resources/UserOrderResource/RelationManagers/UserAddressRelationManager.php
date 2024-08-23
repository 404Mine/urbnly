<?php

namespace App\Filament\EndUser\Resources\UserOrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;

class UserAddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                ->required()
                ->maxLength(255),
                TextInput::make('last_name')
                ->required()
                ->maxLength(255),
                TextInput::make('phone')
                ->label('Contact  Number')
                ->placeholder('e.g. 09456013222')
                ->numeric()
                ->Length(11),
                TextInput::make('city')
                ->required()
                ->maxLength(255),
                TextArea::make('street_address')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('Full Name')
                ->label('Full Name'),
                TextColumn::make('phone')
                ->label('Contact Number'),
                TextColumn::make('street_address')
                ->label('Address'),
                TextColumn::make('city')
                ->label('City'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}