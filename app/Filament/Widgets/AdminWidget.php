<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Customer; //imported classes
use App\Models\Store;
use App\Models\Product;
use App\Models\Order;

use Filament\Support\Enums\IconPosition; //Position Widget Icon in Descriptions

class AdminWidget extends BaseWidget
{
    protected function getStats(): array {
        return [
            Stat::make('End Users', Customer::count())
            ->descriptionIcon('heroicon-o-user-group' , IconPosition::Before)
            ->description('All Users excluding Admins')
            ->chart([0,1,2,3, Customer::count()])
            ->color(Customer::count() <= 2 ? 'danger' : 'success'),
            Stat::make('Stores', Store::count())
            ->descriptionIcon('heroicon-o-building-storefront' , IconPosition::Before)
            ->description('Available Stores')
            ->color(Store::count() <= 2 ? 'danger' : 'success'),
            Stat::make('Total Products', Product::count())
            ->descriptionIcon('heroicon-o-arrow-trending-up')
            ->description('Total Count of Products')
            ->chart([0,5,7,8,9,10,12,15, Product::count()])
            ->color(Product::count() <= 7 ? 'danger' : 'success'),
        ];
    }

    protected static ?string $pollingInterval = '60s';

    protected static bool $isLazy = false;

    //pending more widgets, check dc channel for reference
    //LineChart Widget
}
