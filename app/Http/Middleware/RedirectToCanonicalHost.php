<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The production docroot is the project root, whose .htaccess hands every
 * request to server.php, so the www rule in public/.htaccess never runs.
 * Without this, updaz.fr and www.updaz.fr both answer 200 and Laravel builds
 * internal links from whichever host was requested.
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

        if ($request->getHost() === $canonicalHost) {
            return $next($request);
        }

        $canonicalScheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'https';

        return redirect()->away("{$canonicalScheme}://{$canonicalHost}{$request->getRequestUri()}", 301);
    }
}
