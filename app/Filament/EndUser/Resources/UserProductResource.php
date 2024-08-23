<?php

namespace App\Filament\EndUser\Resources;

use App\Filament\EndUser\Resources\UserProductResource\Pages;
use App\Filament\EndUser\Resources\UserProductResource\RelationManagers;
use App\Models\UserProduct;
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
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Tables\Filters\SelectFilter;

use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

use App\Models\Product;

class UserProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Store Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                        TextInput::make('name')
                        ->maxLength(255)
                        ->required()
                        ->live(onBlur : true)   //every letter requests from server, so added onBlur so that there arent too many requests and have smooth creation
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create'? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                        ->maxLength(255)
                        ->disabled()
                        ->required()
                        ->dehydrated()
                        ->unique(Product::class, 'slug', ignoreRecord: true),

                        MarkDownEditor::make('description')
                        ->placeholder('Input your Text Here...')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products')
                    ])->columns(2),
                    Section::make('images')->schema([
                        FileUpload::make('images')
                        ->multiple()
                        ->maxFiles(3)
                        ->directory('products')
                        ->reorderable(),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                        ->numeric(10, 2)
                        ->required()
                        ->prefix('PHP'),
                    ]),
                    Section::make('Associations')->schema([
                        Select::make('store_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('store', 'name'),

                        Select::make('category_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('category', 'name'),

                        Select::make('sex_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('sex', 'name'),

                        Select::make('bodytype_id')
                        ->searchable()
                        ->preload()
                        ->relationship('bodytype', 'name'),
                    ]),
                    Section::make('Product Status')->schema([
                        Toggle::make('is_active')
                        ->label('Is Active')
                        ->required()
                        ->default(false)
                        ->disabled()
                        ->dehydrated(),

                        Toggle::make('is_featured')
                        ->label('Is Featured')
                        ->required()
                        ->default(false),

                        Toggle::make('in_stock')
                        ->label('In Stock')
                        ->required()
                        ->default(true),

                        Toggle::make('on_sale')
                        ->label('On Sale')
                        ->required()
                        ->default(false),
                    ])->columns(2),
                ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable(),
                TextColumn::make('store.name')
                ->searchable(),
                TextColumn::make('category.name')
                ->searchable(),
                TextColumn::make('price')
                ->prefix('₱')
                ->sortable(),
                TextColumn::make('description')
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                ->label('Active')
                ->boolean(),
                IconColumn::make('in_stock')
                ->label('In Stock')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('on_sale')
                ->label('On Sale')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_featured')
                ->label('Featured')
                ->boolean()
                ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('category')
                ->relationship('category', 'name'),
                SelectFilter::make('sex')
                ->relationship('sex', 'name'),
                SelectFilter::make('bodytype')
                ->relationship('bodytype', 'name'),
                SelectFilter::make('store')
                ->relationship('store', 'name')
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
            'index' => Pages\ListUserProducts::route('/'),
            'create' => Pages\CreateUserProduct::route('/create'),
            'edit' => Pages\EditUserProduct::route('/{record}/edit'),
        ];
    }

    /**
     * Below is filtering the results of table listing to:
     * [Who's Logged in, Owns a store, Which Store, List it's Products]
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
                return parent::getEloquentQuery()->where('store_id', $store_id);
            }
            else {
                return parent::getEloquentQuery()->where('store_id', null);
            }
        }
        else if($user->isAdmin()) {
                return parent::getEloquentQuery();
        }
        else {
            return parent::getEloquentQuery()->where('store_id', null);
        }
    }
}
