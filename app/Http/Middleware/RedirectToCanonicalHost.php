<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The production docroot is the project root, whose .htaccess hands every
 * request to server.php, so the https, www and trailing-slash rules in
 * public/.htaccess never run. Without this, updaz.fr and www.updaz.fr both
 * answer 200 and Laravel builds internal links from whichever host was
 * requested. Scheme, host and trailing slash are fixed in a single 301.
 */
class RedirectToCanonicalHost
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $canonicalHost = parse_url(config('app.url'), PHP_URL_HOST);

        if (! $canonicalHost) {
            return $next($request);
        }

        $canonicalScheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'https';

        $path = $request->getPathInfo();
        $canonicalPath = $path === '/' ? $path : rtrim($path, '/');

        $isCanonical = $request->getHost() === $canonicalHost
            && $request->getScheme() === $canonicalScheme
            && $path === $canonicalPath;

        if ($isCanonical) {
            return $next($request);
        }

        $queryString = $request->getQueryString();
        $canonicalUrl = "{$canonicalScheme}://{$canonicalHost}{$request->getBaseUrl()}{$canonicalPath}";

        return redirect()->away($queryString ? "{$canonicalUrl}?{$queryString}" : $canonicalUrl, 301);
    }
}
