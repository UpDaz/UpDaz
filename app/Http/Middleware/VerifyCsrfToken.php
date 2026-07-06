<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Authenticated by its own Ed25519 signature check
        // (VerifyDiscordSignature), not a session-bound CSRF token.
        'discord/interactions',
    ];
}
