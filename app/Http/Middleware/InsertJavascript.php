<?php

namespace App\Http\Middleware;

use Closure;
use JavaScript;

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
     * @throws \Throwable
     */
    public function handle($request, Closure $next)
    {
        $termsOfServicePage = cache('termsOfServicePage');
        JavaScript::put([
            'locale'        => app()->getLocale(),
            'cookieConsent' => __('cookieconsent'),
            'sumoSelect'    => __('sumoselect'),
            'templates' => [
                'loading' => view('components.common.notifications.loading')->render(),
            ],
            'static'        => __('static'),
            'routes'        => [
                'page' => [
                    'termsOfService' => $termsOfServicePage
                        ? route('simplePage.show', $termsOfServicePage->url)
                        : null,
                ],
            ],
        ]);

        return $next($request);
    }
}
