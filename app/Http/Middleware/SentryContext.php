<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentry\State\Scope;

use function Sentry\configureScope;

class SentryContext
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->bound('sentry')) {
            configureScope(function (Scope $scope): void {
                if (auth()->check()) {
                    $scope->setUser(auth()->user()->toArray());
                }
                $scope->setExtra('session', session()->all());
            });
        }

        return $next($request);
    }
}
