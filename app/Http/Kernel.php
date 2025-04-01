<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Router;

class Kernel extends HttpKernel
{
    /**
     * O conjunto de middleware global da aplicação.
     *
     * Estes middleware são executados durante todas as requisições para a aplicação.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Http\Middleware\SetCacheHeaders::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        #\Illuminate\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Illuminate\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\CorsMiddleware::class,
    ];

    /**
     * O conjunto de middleware que são carregados em grupos.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            #\App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,  // Middleware para autenticação Sanctum
            'throttle:api',  // Limitação de taxa das requisições
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            
        ],
    ];

    /**
     * O conjunto de middleware padrão da aplicação.
     *
     * @var array
     */
    protected $routeMiddleware = [
        #'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        #'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    /**
     * Registra quaisquer rotas ou middleware adicionais que o aplicativo possa precisar.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group([
            #'namespace' => $this->namespace,
            'middleware' => 'web',
        ], function ($router) {
            require base_path('routes/web.php');
        });

        $router->group([
           # 'namespace' => $this->namespace,
            'middleware' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
