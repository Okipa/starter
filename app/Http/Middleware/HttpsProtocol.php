<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
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
        if (! $request->secure() && in_array(app()->environment(), ['preprod', 'production'])) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
