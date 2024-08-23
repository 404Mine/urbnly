<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Filtering Options';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()
                    ->schema([
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
                        ->unique(Category::class, 'slug', ignoreRecord: true)
                    ]),

                    Toggle::make('is_active')
                    ->required()
                    ->default(true),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
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
        return static::getModel()::count() <= 3 ? 'danger' : 'success';
    }
}
