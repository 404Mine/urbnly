<?php

namespace App\Filament\EndUser\Resources;

use App\Filament\EndUser\Resources\UserOrderResource\Pages;
use App\Filament\EndUser\Resources\UserOrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\UserOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Hidden;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

use Illuminate\Support\Number;

use Filament\Forms\Set;
use Filament\Forms\Get;

use App\Models\Product;
use App\Models\Order;

class UserOrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Store Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('customer_id')
                        ->label('Customer')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                        Select::make('payment_method')
                        ->options([
                            'stripe' => 'Stripe',
                            'cod' => 'Cash on Delivery'
                        ])
                        ->required(),

                        Select::make('payment_status')
                        ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed',
                        ])
                        ->default('pending')
                        ->required(),

                        ToggleButtons::make('status')
                        ->options([
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'canceled' => 'Cancelled'
                        ])
                        ->colors([
                            'new' => 'info',
                            'processing' => 'stone',
                            'shipped' => 'success',
                            'canceled' => 'danger'
                        ])
                        ->icons([
                            'new' => 'heroicon-o-sparkles',
                            'processing' => 'heroicon-o-clock',
                            'shipped' => 'heroicon-o-check',
                            'canceled' => 'heroicon-o-x-mark'
                        ])
                        ->inline()
                        ->default('new')
                        ->required(),

                        Select::make('shipping_method')
                        ->options([
                            'lalamove' => 'Lalamove',
                            'j&t' => 'J&T Express',
                            'grab' => 'Grab Express',
                            'deliparc' => 'Delivery Parcel Express' 
                        ]),

                        Textarea::make('notes')
                        ->columnSpanFull()
                    ])->columns(2),

                    Section::make('Order Items')->schema([
                        Repeater::make('orderItem')
                        ->label('Items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                return $set('unit_amount', Product::find($state)->price ?? 0);
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                return $set('total_amount', Product::find($state)->price ?? 0);
                            })
                            ->columnSpan(4),

                            TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get){
                                return $set('total_amount', $state*$get('unit_amount'));
                            })
                            ->columnSpan(2),

                            TextInput::make('unit_amount')
                            ->prefix('₱')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(3),

                            TextInput::make('total_amount')
                            ->prefix('₱')
                            ->numeric()
                            ->required()
                            ->dehydrated()
                            ->columnSpan(3),
                        ])->columns(12),

                        Placeholder::make('grand_total_placeholder')
                        ->label('Overall Total')
                        ->content(function (Get $get, Set $set) {
                            $total = 0;
                            if (!$repeaters = $get('orderItem')) {
                                return $total;
                            }
                            foreach ($repeaters as $key => $repeater) {
                                $total += $get("orderItem.{$key}.total_amount");
                            }
                            $set('grand_total', $total);
                            return Number::currency($total, 'PHP');
                        }),

                        Hidden::make('grand_total')
                        ->default(0),
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                ->sortable()
                ->searchable(),

                TextColumn::make('grand_total')
                ->numeric()
                ->sortable()
                ->money('PHP'),

                TextColumn::make('payment_method')
                ->searchable()
                ->sortable(),

                TextColumn::make('payment_status')
                ->searchable()
                ->sortable(),

                TextColumn::make('shipping_method')
                ->searchable()
                ->sortable(),

                SelectColumn::make('status')
                ->searchable()
                ->sortable()
                ->options([
                    'new' => 'New',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'canceled' => 'Cancelled'
                ]),

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
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
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
            AddressRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserOrders::route('/'),
            'create' => Pages\CreateUserOrder::route('/create'),
            'view' => Pages\ViewUserOrder::route('/{record}'),
            'edit' => Pages\EditUserOrder::route('/{record}/edit'),
        ];
    }
}
