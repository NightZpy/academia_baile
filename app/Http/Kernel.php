<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        //\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        //\MisterPhilip\MaintenanceMode\Http\Middleware\CheckForMaintenanceMode::class,
        Middleware\CheckMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
        'ownAcademy' => \App\Http\Middleware\OwnAcademy::class,
        'ownDancer' => \App\Http\Middleware\OwnDancer::class,
        'ownCompetitor' => \App\Http\Middleware\OwnCompetitor::class,
        'ownPayment' => \App\Http\Middleware\OwnPayment::class,
    ];
}
