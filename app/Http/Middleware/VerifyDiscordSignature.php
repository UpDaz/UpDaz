<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SodiumException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Verifies the Ed25519 signature Discord attaches to every request sent
 * to an Interactions Endpoint URL — this is the entire authorization
 * mechanism for that endpoint (no session, no bot connection involved).
 *
 * @link https://discord.com/developers/docs/interactions/receiving-and-responding#security-and-authorization
 */
class VerifyDiscordSignature
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $signature = $request->header('X-Signature-Ed25519');
        $timestamp = $request->header('X-Signature-Timestamp');
        $publicKey = config('services.discord.public_key');

        if (! $signature || ! $timestamp || ! $publicKey) {
            abort(401, 'Missing Discord signature.');
        }

        $signatureBytes = hex2bin($signature);
        $publicKeyBytes = hex2bin($publicKey);

        if ($signatureBytes === false || $publicKeyBytes === false) {
            abort(401, 'Malformed Discord signature.');
        }

        try {
            $verified = sodium_crypto_sign_verify_detached(
                $signatureBytes,
                $timestamp . $request->getContent(),
                $publicKeyBytes
            );
        } catch (SodiumException) {
            abort(401, 'Malformed Discord signature.');
        }

        if (! $verified) {
            abort(401, 'Invalid Discord signature.');
        }

        return $next($request);
    }
}
