<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\PembagianHalte;
use App\Filament\Widgets\PengaduanChart;
use App\Filament\Widgets\PenggunaChart;
use App\Filament\Widgets\PenghasilanChart;
use App\Filament\Widgets\PopularitasRuteChart;
use App\Filament\Widgets\TransaksiChart;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->passwordReset()
            ->colors([
                'primary' => 'rgb(0,50,115)',
            ])
            ->brandLogo(fn () => view('components.logo'))
            ->brandLogoHeight('2rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                TransaksiChart::class,
                PenghasilanChart::class,
                PopularitasRuteChart::class,
                PenggunaChart::class,
                PengaduanChart::class,
                PembagianHalte::class,
            ])
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop(true)
            ->sidebarWidth('17rem')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
            ->defaultThemeMode(ThemeMode::Light)
            ->authMiddleware([
                Authenticate::class,
            ])
            ->favicon(asset('favicon.ico'))
            ->spa()
            ->plugins([]);
    }
}