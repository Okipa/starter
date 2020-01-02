<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use App\Models\SimplePage;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ShareDataGlobally
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
        // cache static items
        $sharedData = [
            'settings' => cache()->rememberForever('settings', function () {
                return (new Settings)->with(['media'])->first();
            }),
        ];
        // cache dynamic items
        $toCache = new Collection();
        $toCache->push((new SimplePage)->where('active', true)->get());
        foreach ($toCache->flatten() as $item) {
            $key = Str::camel($item->slug);
            $sharedData[$key] = cache()->rememberForever($key, function () use ($item) {
                return $item;
            });
        }
        // share items to views
        foreach ($sharedData as $key => $value) {
            view()->share($key, $value);
        }

        return $next($request);
    }
}
