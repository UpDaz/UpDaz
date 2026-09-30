<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Checks a third-party image before it is embedded in an article: it must
 * answer, be an image, and weigh at most `blog.max_image_kilobytes`. The
 * weight is read from the headers only, the image itself is never
 * downloaded.
 */
class RemoteImageInspector
{
    private const TIMEOUT_SECONDS = 5;

    public function isEmbeddable(string $url): bool
    {
        $sizeInBytes = $this->sizeInBytes($url);

        if ($sizeInBytes === null) {
            debug('[RemoteImageInspector] Image écartée : poids inconnu ou image inaccessible', ['url' => $url]);

            return false;
        }

        $maxBytes = (int) config('blog.max_image_kilobytes') * 1024;

        if ($sizeInBytes > $maxBytes) {
            debug('[RemoteImageInspector] Image écartée : trop lourde', ['url' => $url, 'octets' => $sizeInBytes]);

            return false;
        }

        return true;
    }

    /**
     * From `Content-Length` on a HEAD request, or, for servers that omit
     * it there, from `Content-Range` on a one-byte ranged GET.
     */
    private function sizeInBytes(string $url): ?int
    {
        try {
            $head = Http::timeout(self::TIMEOUT_SECONDS)->head($url);

            if (! $this->isImage($head)) {
                return null;
            }

            if ($head->header('Content-Length') !== '') {
                return (int) $head->header('Content-Length');
            }

            $range = Http::timeout(self::TIMEOUT_SECONDS)
                ->withHeaders(['Range' => 'bytes=0-0'])
                ->get($url);
        } catch (Throwable) {
            return null;
        }

        if (! preg_match('#/(\d+)$#', $range->header('Content-Range'), $matches)) {
            return null;
        }

        return (int) $matches[1];
    }

    private function isImage(Response $response): bool
    {
        return $response->successful()
            && str_starts_with($response->header('Content-Type'), 'image/');
    }
}
