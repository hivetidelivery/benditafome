<?php

namespace BenditaFome\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \BenditaFome\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \BenditaFome\Http\Middleware\VerifyCsrfToken::class,
        \LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                       => \BenditaFome\Http\Middleware\Authenticate::class,
        'auth.basic'                 => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'                      => \BenditaFome\Http\Middleware\RedirectIfAuthenticated::class,
        'authRole'                   => \BenditaFome\Http\Middleware\AuthRole::class,
        'oauth-role'                  => \BenditaFome\Http\Middleware\OAuthRole::class,

        'oauth'                      => \LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware::class,
        'oauth-user'                 => \LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware::class,
        'oauth-client'               => \LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware::class,
        'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,
    ];
}
