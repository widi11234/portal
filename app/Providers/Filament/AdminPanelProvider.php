<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use EightyNine\Reports\ReportsPlugin;
use Illuminate\Support\Facades\Blade;
use Orion\FilamentBackup\BackupPlugin;
use EightyNine\Approvals\ApprovalPlugin;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\LatestMeasurement;
use Rmsramos\Activitylog\ActivitylogPlugin;
use LaraZeus\DynamicDashboard\Models\Layout;
use LaraZeus\DynamicDashboard\Models\Columns;
use lockscreen\FilamentLockscreen\Lockscreen;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Brickx\MaintenanceSwitch\MaintenanceSwitchPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use LaraZeus\DynamicDashboard\DynamicDashboardPlugin;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use TomatoPHP\FilamentAccounts\FilamentAccountsPlugin;
use BetterFuturesStudio\FilamentLocalLogins\LocalLogins;
use Filament\Http\Middleware\DisableBladeIconComponents;
use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use Shipu\WebInstaller\Middleware\RedirectIfNotInstalled;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use TomatoPHP\FilamentAccounts\FilamentAccountsSaaSPlugin;
use Edwink\FilamentUserActivity\FilamentUserActivityPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
use App\Filament\Resources\DailyPatrolResource\Widgets\LatestPatrol;
use App\Filament\Resources\DailyPatrolResource\Widgets\DailyPatrolChart;
use Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin;
use App\Filament\Resources\DailyPatrolResource\Widgets\DailyPatrolChart_2;
use App\Filament\Resources\DailyPatrolResource\Widgets\DailyPatrolChart_3;
use App\Filament\Resources\DailyPatrolResource\Widgets\DailyPatrolChart_4;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use JulioMotol\FilamentPasswordConfirmation\FilamentPasswordConfirmationPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandName('ESD PORTAL')
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                'Data master',
                'Data measurement',
                'Settings',
            ])
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            // ->emailVerification()
            // ->passwordReset()
            ->databaseNotifications()
            // ->registration()
            //->profile()
            ->colors([
                'primary' => Color::Blue,
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
                LatestMeasurement::class,
                LatestPatrol::class,
                UserStatsOverview::class,
                DailyPatrolChart::class,
                DailyPatrolChart_2::class,
                DailyPatrolChart_3::class,
                DailyPatrolChart_4::class,
                
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
                //FilamentSpatieLaravelBackupPlugin::make(),
                FilamentShieldPlugin::make(),
                ActivitylogPlugin::make(),
                FilamentUserActivityPlugin::make(),
                // FilamentGeneralSettingsPlugin::make()
                //     ->canAccess(fn() => auth()->user()->id === 1)
                //     ->setSort(3)
                //     ->setIcon('heroicon-o-cog')
                //     ->setNavigationGroup('Settings')
                //     ->setTitle('General Settings')
                //     ->setNavigationLabel('General Settings'),
                new LocalLogins(),
                //MaintenanceSwitchPlugin::make(),
                //FilamentSpatieLaravelHealthPlugin::make(),
                DynamicDashboardPlugin::make()
                    ->models([
                        'Layout' => Layout::class,
                        'Columns' => Columns::class
                    ])
                
                    ->uploadDisk('public')
                    ->uploadDirectory('layouts')
                
                    ->navigationGroupLabel('Dynamic Dashboard')
                
                    ->hideLayoutResource()
                
                    ->defaultLayout('new-page'),
                //FilamentAuthenticationLogPlugin::make()
                // RenewPasswordPlugin::make()
                //     ->routeName('confirm')
                //     ->routeUri('auth/confirm')
                //     ->routeMiddleware(FooMiddleware::class) // Accepts string|array
                //     ->passwordTimeout(10800)
                //ReportsPlugin::make()
                // FilamentAccountsPlugin::make()
                //     ->useAccountMeta()
                //     ->showAddressField()
                //     ->showTypeField()
                //     ->useRequests()
                //     ->useContactUs()
                //     ->useLoginBy()
                //     ->useAvatar()
                //     ->useAPIs()
                //     ->canLogin()
                //     ->canBlocked()
                //     //->useTeams()
                //     ->useNotifications()
                //     ->useLocations()
                //     ->useTypes(),
                    // ->useImpersonate()
                    // ->impersonateRedirect('/app'),
                // FilamentAccountsSaaSPlugin::make()
                //     ->databaseNotifications()
                //     ->checkAccountStatusInLogin()
                //     //->APITokenManager()
                //     // ->editTeam()
                //     // ->deleteTeam()
                //     // ->teamInvitation()
                //     ->showTeamMembers()
                //     ->editProfile()
                //     ->editPassword()
                //     ->browserSesstionManager()
                //     ->deleteAccount()
                //     ->editProfileMenu()
                //     //->registration()
                //     ->useOTPActivation(),
            ])
            ->plugin(
                new Lockscreen()
                )
            ->authMiddleware([
                // ...
                 Locker::class,
                 RedirectIfNotInstalled::class, // <- Add this
            ]);
    }
}
