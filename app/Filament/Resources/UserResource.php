<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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

use Filament\Tables\Columns\TextColumn;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack'; //change this later

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required(),
                Forms\Components\TextInput::make('username')
                ->required(),
                Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrated(fn($state)=>filled($state))
                ->revealable()
                ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
                
                Forms\Components\DateTimePicker::make('email_verified_at')
                ->label('Email Verified At')
                //->timezone('Asia/Singapore')  Changed config/app.php timezone so it's default
                ->default(now()),
                Forms\Components\TextInput::make('email')
                ->label('Email Address')
                ->email()
                ->maxLength(255)
                ->unique(ignoreRecord:True)
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('username')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('email')
                ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                //->timezone('Asia/Singapore')  Changed config/app.php timezone so it's default
                ->datetime()
                ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                ->datetime()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
        return static::getModel()::count() === 0 ? 'danger' : 'success';
    }
}
