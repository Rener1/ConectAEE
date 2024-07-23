<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'checkNotificacao' => \App\Http\Middleware\CheckNotificacao::class,
        'checkCadastrado' => \App\Http\Middleware\CheckCadastrado::class,
        'checkNaoCadastrado' => \App\Http\Middleware\CheckNaoCadastrado::class,
        'checkGerenciaAluno' => \App\Http\Middleware\CheckGerenciaAluno::class,
        'checkGerenciaAlunoAdministrador' => \App\Http\Middleware\CheckGerenciaAlunoAdministrador::class,
        'checkGerenciaAdministrador' => \App\Http\Middleware\CheckGerenciaAdministrador::class,
        'checkNaoResponsavel' => \App\Http\Middleware\CheckNaoResponsavel::class,
        'checkObjetivo' => \App\Http\Middleware\CheckObjetivo::class,
        'checkObjetivoCriador' => \App\Http\Middleware\CheckObjetivoCriador::class,
        'checkAtividadeCriador' => \App\Http\Middleware\CheckAtividadeCriador::class,
        'checkObjetivoNaoCriador' => \App\Http\Middleware\CheckObjetivoNaoCriador::class,
        'checkSugestao' => \App\Http\Middleware\CheckSugestao::class,
        'checkSugestaoCriador' => \App\Http\Middleware\CheckSugestaoCriador::class,
        'checkFeedbackCriador' => \App\Http\Middleware\CheckFeedbackCriador::class,
        'checkAlbum' => \App\Http\Middleware\CheckAlbum::class,
        'checkAlbumCriador' => \App\Http\Middleware\CheckAlbumCriador::class,
        'checkInstituicaoCriador' => \App\Http\Middleware\CheckInstituicaoCriador::class,
        'checkPdi' => \App\Http\Middleware\CheckPDI::class,
        'checkPdiCriador' => \App\Http\Middleware\CheckPDICriador::class,
        'checkPdiArquivoCriador' => \App\Http\Middleware\CheckPdiArquivoCriador::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
