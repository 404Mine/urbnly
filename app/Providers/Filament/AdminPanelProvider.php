<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Filament\Auth\CustomLogin;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Zinc,
                'info' => Color::Blue,
                'primary' => Color::Cyan,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'slate' => Color::Slate,
                'stone' => Color::Stone,
            ])
            ->userMenuItems([
                MenuItem::make()
                ->label('Home')
                ->url('/')
                ->icon('heroicon-o-home'),
            ])
            ->navigationItems([
                NavigationItem::make('Home')
                ->url('/')
                ->icon('heroicon-o-home')
                ->group('External Links')
                ->sort(2),
                NavigationItem::make('Contacts')
                ->url('/Contacts')
                ->group('External Links')
                ->sort(2)
                ->icon('heroicon-o-phone'),
                NavigationItem::make('Online Store')
                ->url('/Online-Store')
                ->group('External Links')
                ->sort(2)
                ->icon('heroicon-o-shopping-bag'),
            ])
            ->favicon(asset('storage/urbnlyicontransparent.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            //->discoverResources(in: app_path('Filament/EndUser/Resources'), for: 'App\\Filament\\EndUser\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //Widgets\StatsAdminOverview::class,  sample import
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
