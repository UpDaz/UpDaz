<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if ($request->method() === 'POST' && $request->has('g-recaptcha-response')) {
            if (!$this->verifyToken($request->get('g-recaptcha-response'))) {
                abort(500);
            }
        }
        return $next($request);
    }

    private function verifyToken(string $token): bool
    {
        $data = http_build_query(
            array(
                'secret' => config('custom.recaptcha.secret'),
                'response' => $token,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        );
        $options = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response);
        return (bool) $result->success;
    }
}
