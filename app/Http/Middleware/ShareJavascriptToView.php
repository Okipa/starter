<?php

namespace App\Http\Middleware;

use App\Models\Cookies\CookieService;
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
    public function handle(Request $request, Closure $next): mixed
    {
        $gdprPage = pages()->where('unique_key', 'gdpr_page')->first();
        share([
            'domain' => request()->getHost(),
            'locale' => app()->getLocale(),
            'notify' => __('notify'),
            'gdpr_page_url' => $gdprPage ? route('page.show', $gdprPage) : null,
            'cookie_categories' => cookieCategories(),
        ]);

        return $next($request);
    }
}
