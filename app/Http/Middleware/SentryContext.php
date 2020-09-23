<?php

namespace App\Http\Middleware;

use Closure;
use Sentry\State\Scope;
use function Sentry\configureScope;

class SentryContext
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && app()->bound('sentry')) {
            configureScope(function (Scope $scope): void {
                $scope->setUser(auth()->user()->toArray());
            });
        }

        return $next($request);
    }
}
