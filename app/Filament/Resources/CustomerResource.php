<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Store Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('name')
                ->label('Full Name')
                ->placeholder('First Name, Last name')
                ->required(),
                TextInput::make('username')
                ->required(),
                TextInput::make('password')
                ->password()
                ->dehydrated(fn($state)=>filled($state))
                ->revealable()
                ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
                TextInput::make('email')
                ->label('Email Address')
                ->placeholder('sampleemail@gmail.com')
                ->email()
                ->maxLength(255)
                ->unique(ignoreRecord:True)
                ->required(),
                TextInput::make('contact')
                ->label('Contact  Number')
                ->placeholder('e.g. 09456013222')
                ->numeric()
                ->Length(11)
                ->unique(ignoreRecord : true)
                ->required(),
                TextInput::make('address')
                ->label('Complete Address')
                ->placeholder('Subdivision, City, Blk, Lot, Street')
                ->required(),
                Select::make('role')
                ->options(Customer::ROLES)
                //->default('CUSTOMER')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable(),
                TextColumn::make('username')
                ->searchable()
                ->sortable(),
                TextColumn::make('email')
                ->searchable()
                ->sortable(),
                TextColumn::make('contact')
                ->searchable(),
                TextColumn::make('address')
                ->searchable(),
                TextColumn::make('role')
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    /**
     *  This is for the numbers Per Resources
     *  This just includes the Widget for that and color config
     *  By @404Mine
     */

     public static function getNavigationBadge(): ?string {
        return static::getModel() :: count();
    }
    public static function getNavigationBadgeColor(): string|array|null {
        return static::getModel()::count() <= 2 ? 'danger' : 'success';
    }
}
