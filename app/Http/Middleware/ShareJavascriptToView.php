<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShareJavascriptToView
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
        share(['locale' => app()->getLocale(), 'notify' => __('notify')]);

        return $next($request);
    }
}
