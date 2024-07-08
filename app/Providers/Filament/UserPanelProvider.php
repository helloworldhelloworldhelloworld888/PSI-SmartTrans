<?php

namespace App\Providers\Filament;

use App\Filament\User\Pages\Auth\LoginUser;
use App\Filament\User\Pages\Auth\Register;
use App\Filament\User\Pages\Dashboard;
use App\Filament\User\Pages\Profile;
use App\Http\Middleware\IsAdmin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('/')
            ->login(LoginUser::class)
            ->registration(Register::class)
            ->passwordReset()
            ->profile(Profile::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->colors([
                'primary' => 'rgb(0,50,115)',
            ])
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->brandLogo(fn () => view('components.logo'))
            ->brandLogoHeight('2rem')
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop(true)
            ->sidebarWidth('17rem')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
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
                IsAdmin::class,
            ])
            ->defaultThemeMode(ThemeMode::Light)
            ->favicon(asset('favicon.ico'))
            ->spa();
    }
}
