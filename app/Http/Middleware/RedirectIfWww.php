<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Canonical host is non-www (matches sitemap.xml and Google Search Console
 * property — see task #14 in Task_List_Review_Website_AL_MANAR.md). Redirects
 * any "www." host to its non-www equivalent, preserving scheme/path/query.
 */
class RedirectIfWww
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        if (str_starts_with($host, 'www.')) {
            $canonicalHost = substr($host, 4);
            $url = $request->getScheme() . '://' . $canonicalHost . $request->getRequestUri();

            return redirect()->away($url, 301);
        }

        return $next($request);
    }
}
