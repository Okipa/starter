<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InsertJavascript
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
        $gdprPage = pages()->where('unique_key', 'gdpr_page')->first();
        share([
            'locale' => app()->getLocale(),
            'notify' => __('notify'),
            'cookieConsent' => __('cookieconsent'),
            'gdprPage' => ['route' => $gdprPage ? route('page.show', $gdprPage) : null],
        ]);

        return $next($request);
    }
}
