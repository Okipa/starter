<?php

if (! function_exists('currentRouteIs')) {
    function currentRouteIs(string $name): bool
    {
        return Route::is($name) || Route::is(app()->getLocale() . '.' . $name);
    }
}

if (! function_exists('currentUrlIs')) {
    function currentUrlIs(string $url): bool
    {
        return Request::url() === $url;
    }
}
