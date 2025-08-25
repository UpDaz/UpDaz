<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() === 'POST' && $request->has('recaptcha-response')) {
            if (!$this->verifyToken($request->get('recaptcha-response'))) {
                abort(500);
            }
        }
        return $next($request);
    }

    private function verifyToken(string $token): bool
    {
        $response = Http::post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret' => config('custom.recaptcha.secret'),
                'response' => $token,
                'remoteip' => request()->ip(),
            ]
        );

        return $response->json()['success'];
    }
}
