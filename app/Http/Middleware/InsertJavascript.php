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
     */
    public function handle($request, Closure $next)
    {
        $termsOfServicePage = pages()->where('slug', 'terms-of-service-page')->first();
        JavaScript::put([
            'locale' => app()->getLocale(),
            'sweetalert' => __('sweetalert'),
            'cookieConsent' => __('cookieconsent'),
            'sumoSelect' => __('sumoselect'),
            'termsOfService' => ['route' => $termsOfServicePage ? route('page.show', $termsOfServicePage) : null],
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
