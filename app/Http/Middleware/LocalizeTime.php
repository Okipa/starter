<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
    public function handle(Request $request, Closure $next)
    {
        // ToDo: replace this line by `setlocale(LC_TIME, 'fr_FR' . '.UTF-8')` if your app is not multilingual.
        setlocale(LC_TIME, currentLocale()['regional'] . '.UTF-8');
        // ToDo: replace this line by `Carbon::setLocale('fr')` if your app is not multilingual.
        Carbon::setLocale(app()->getLocale());

        return $next($request);
    }
}
