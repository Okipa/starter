<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class SeoController extends Controller
{
    public function robotsTxt(): Response
    {
        $sitemap = url('sitemap.xml');
        $robotsTxtContent = app()->environment() === 'production'
            ? <<<EOT
User-agent: *
Disallow:
Sitemap: $sitemap
EOT
            : <<<EOT
User-agent: *
Disallow: /
EOT;

        return response()->make($robotsTxtContent)->header('Content-Type', 'text/plain');
    }
}
