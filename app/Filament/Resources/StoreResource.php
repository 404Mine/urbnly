<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers;
use App\Models\Store;
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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Store Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Store Information')->schema([
                        TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur : true)   //every letter requests from server, so added onBlur so that there arent too many requests and have smooth creation
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create'? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                        ->maxLength(255)
                        ->disabled()
                        ->required()
                        ->dehydrated()
                        ->unique(Store::class, 'slug', ignoreRecord: true),

                        TextInput::make('contact')
                        ->label('Contact Number')
                        ->placeholder('e.g. 09456013222')
                        ->numeric()
                        ->Length(11)
                        ->unique(ignoreRecord : true)
                        ->required(),

                        TextInput::make('email')
                        ->label('Email Address')
                        ->placeholder('sample_email@gmail.com')
                        ->email()
                        ->maxLength(255)
                        ->unique(ignoreRecord : true)
                        ->required(),
                    ])->columns(2),
                    Section::make('Images')->schema([
                        FileUpload::make('image')
                        ->label('')
                        ->image()
                        ->directory('stores'),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Store Owner')->schema([
                        Select::make('customer_id')
                        ->label('')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('customer' , 'name'),

                        Toggle::make('is_active')
                        ->label('Is Active')
                        ->required()
                        ->default(true),

                    ]),
                    Section::make('Physical Addresses')->schema([
                        TextInput::make('location')
                        ->label('Physical Location')
                        ->placeholder('Subdivision, City, Blk, Lot, Street'),
                    ])
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('name')
                ->label('Store Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('customer.name')
                ->label('Store Owner')
                ->sortable(),
                TextColumn::make('email')
                ->label('Email Address'),
                TextColumn::make('contact')
                ->label('Contact No.')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location')
                ->label('Store Location')
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                ->label('Active')
                ->boolean(),
                TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }

    /**
     * Below function is main for ViewAction
     * This is kinda Cool I like it
     * By @404Mine
     */

    public static function infolist(Infolist $infolist): Infolist {
        return $infolist
            ->schema([
                TextEntry::make('name')
                ->label('Store Name')
                ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('customer.name')
                ->label('Store Owner')
                ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('email')
                ->label('Email Address')
                ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('contact')
                ->label('Contact No.')
                ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('location')
                ->label('Store Location')
                ->size(TextEntry\TextEntrySize::Large),
                TextEntry::make('created_at')
                ->label('Create At')
                ->dateTime()
                ->size(TextEntry\TextEntrySize::Large),
                ImageEntry::make('image')
                ->label('Store Logo'),
            ]);
    }

    /**
     * Below is filtering the results of table listing to:
     * [Who's Logged in, Owns a store, Which Store, List That Store]
     * I need this so they can only edit theirs
     * By @404Mine
     */

    public function __construct($resource, $user) {
        parent::__construct($resource);
        $this->user = $user;
    }
    public static function getEloquentQuery(): Builder {
        $user = auth()->user();
        //return parent::getEloquentQuery()->where('store_id', '=', $user->store_id);
        if($user->isSeller()) {
            if($user->store()->exists()) {
                $store_id = $user->store->first()->id;
                //self::$navigationGroup = 'Manage Your Store';
                return parent::getEloquentQuery()->where('id', $store_id);
            }
            else {
                return parent::getEloquentQuery()->where('id', null);
            }
        }
        else if($user->isAdmin()) {
            //self::$navigationGroup = 'Registered Stores / Customers';     doesn't always work, due to framework mechanics
            return parent::getEloquentQuery();
        }
        else {
            return parent::getEloquentQuery()->where('id', null);
        }
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
