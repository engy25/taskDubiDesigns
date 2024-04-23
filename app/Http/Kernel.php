<?php

namespace App\Http;
// use Spatie\Permission\Middlewares\PermissionMiddleware;


use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  /**
   * The application's global HTTP middleware stack.
   *
   * These middleware are run during every request to your application.
   *
   * @var array<int, class-string|string>
   */
  protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    \App\Http\Middleware\TrustProxies::class,
    \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    \Laravel\Telescope\Http\Middleware\Authorize::class,
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array<string, array<int, class-string|string>>
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
      \App\Http\Middleware\LocaleMiddleware::class,
      \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,

    ],

    'api' => [
      // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
      'throttle:api',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
      \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ],
  ];

  /**
   * The application's route middleware.
   *
   * These middleware may be assigned to groups or used individually.
   *
   * @var array<string, class-string|string>
   */



   protected $middlewareAliases = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
    'signed' => \App\Http\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
];

protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,


    /**** OTHER MIDDLEWARE ****/
    'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
    'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
    'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
    'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,

    // REDIRECTION MIDDLEWARE
    'setLocale' => \App\Http\Middleware\setLocale::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'checkUser' => \App\Http\Middleware\CheckUserMiddleware::class,


    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
  //  'can.access.admins.list' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,

];



  //  protected $routeMiddleware = [
  //   'auth' => \App\Http\Middleware\Authenticate::class,
  //   'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
  //   'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
  //   'can' => \Illuminate\Auth\Middleware\Authorize::class,
  //   'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
  //   'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
  //   'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
  //   'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
  //   'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
  // ];



}
