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
// Plugins Add`
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Solutionforest\FilamentLoginScreen\Filament\Pages\Auth\Themes\Theme1\LoginScreenPage as LoginScreenPage;

class AdministracionPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('administracion')
            ->path('administracion')
            ->login(LoginScreenPage::class)
            ->sidebarCollapsibleOnDesktop()  // Bars Collapsible
            ->brandName('GV - GlorietaShop') // Name Projects
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])
            ->plugins([
                LightSwitchPlugin::make()
                    ->position(Alignment::TopRight)
                    ->enabledOn([
                        'auth.email',
                        'auth.login',
                        'auth.password',
                        'auth.profile',
                        'auth.register',
                    ]),
                FilamentProgressbarPlugin::make()->color('#F7DD48'),
            ]);
    }
}
