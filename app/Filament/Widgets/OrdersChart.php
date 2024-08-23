<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Providers\Filament\AdminPanelProvider;
use Carbon\Carbon;

use App\Models\Order;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        
        $ordersData = $this->getOrdersData();
        $pendingOrdersData = $this->getPendingOrdersData();
        $newOrdersData = $this->getNewOrdersData();
        $shippedOrdersData = $this->getShippedOrdersData();
        $cancelledOrdersData = $this->getCancelledOrdersData();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => array_values($ordersData['counts']),
                    'borderColor' => 'cyan',
                ],
                [
                    'label' => 'Pending Orders',
                    'data' => array_values($pendingOrdersData['counts']),
                    'borderColor' => 'orange',
                ],
                [
                    'label' => 'New Orders',
                    'data' => array_values($newOrdersData['counts']),
                    'borderColor' => 'blue',
                ],
                [
                    'label' => 'Shipped Orders',
                    'data' => array_values($shippedOrdersData['counts']),
                    'borderColor' => 'green',
                ],
                [
                    'label' => 'Cancelled Orders',
                    'data' => array_values($cancelledOrdersData['counts']),
                    'borderColor' => 'red',
                ]
            ],
            'labels' => array_keys($ordersData['counts']),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOrdersData(): array {

        $monthsOfYear = array_map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        }, range(1, 12));

        $orders = Order::selectRaw('count(*) as count, date_format(created_at, "%b") as month')
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->orderByRaw('month(created_at)')
        ->pluck('count', 'month')
        ->toArray();

        $counts = [];
        foreach ($monthsOfYear as $month) {
            $counts[$month] = $orders[$month] ?? 0;
        }

        return compact('counts');
    }

    protected function getPendingOrdersData(): array {
        $monthsOfYear = array_map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        }, range(1, 12));
    
        $orders = Order::selectRaw('count(*) as count, date_format(created_at, "%b") as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'processing')
            ->groupBy('month')
            ->orderByRaw('month(created_at)')
            ->pluck('count', 'month')
            ->toArray();
    
        $counts = [];
        foreach ($monthsOfYear as $month) {
            $counts[$month] = $orders[$month] ?? 0;
        }
    
        return compact('counts');
    }

    protected function getNewOrdersData(): array {
        $monthsOfYear = array_map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        }, range(1, 12));
    
        $orders = Order::selectRaw('count(*) as count, date_format(created_at, "%b") as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'new')
            ->groupBy('month')
            ->orderByRaw('month(created_at)')
            ->pluck('count', 'month')
            ->toArray();
    
        $counts = [];
        foreach ($monthsOfYear as $month) {
            $counts[$month] = $orders[$month] ?? 0;
        }
    
        return compact('counts');
    }

    protected function getShippedOrdersData(): array {
        $monthsOfYear = array_map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        }, range(1, 12));
    
        $orders = Order::selectRaw('count(*) as count, date_format(created_at, "%b") as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'shipped')
            ->groupBy('month')
            ->orderByRaw('month(created_at)')
            ->pluck('count', 'month')
            ->toArray();
    
        $counts = [];
        foreach ($monthsOfYear as $month) {
            $counts[$month] = $orders[$month] ?? 0;
        }
    
        return compact('counts');
    }

    protected function getCancelledOrdersData(): array {
        $monthsOfYear = array_map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        }, range(1, 12));
    
        $orders = Order::selectRaw('count(*) as count, date_format(created_at, "%b") as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'canceled')
            ->groupBy('month')
            ->orderByRaw('month(created_at)')
            ->pluck('count', 'month')
            ->toArray();
    
        $counts = [];
        foreach ($monthsOfYear as $month) {
            $counts[$month] = $orders[$month] ?? 0;
        }
    
        return compact('counts');
    }
}
