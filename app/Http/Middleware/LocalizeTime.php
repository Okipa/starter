<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Route;
use SEO;

class LocalizeTime
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        setlocale(LC_TIME, currentLocale()['regional'] . '.UTF-8');
        Carbon::setLocale(app()->getLocale());

        return $next($request);
    }
}
