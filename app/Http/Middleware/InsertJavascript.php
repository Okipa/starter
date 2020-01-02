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
        $termsOfServiceUrl = data_get(cache('termsOfServicePage'), 'url')
            ? route('simplePage.show', cache('termsOfServicePage')->url)
            : null;
        JavaScript::put([
            'locale' => app()->getLocale(),
            'sweetalert' => __('sweetalert'),
            'cookieConsent' => __('cookieconsent'),
            'sumoSelect' => __('sumoselect'),
            'termsOfService' => ['route' => $termsOfServiceUrl],
        ]);
        // admin only
        if ($request->is('admin/*') || $request->is('*/admin/*')) {
            JavaScript::put([
                'multilingual' => [
                    'template' => [
                        'formLangSwitcher' => view('components.admin.multilingual.form-lang-switcher')->toHtml(),
                    ],
                ],
            ]);
        }

        return $next($request);
    }
}
