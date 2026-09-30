<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\ResponseCache\Facades\ResponseCache;

/**
 * An obsolete blog URL: a 301 to `to_path`, or a 410 when `to_path` is null.
 */
class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_path',
        'to_path',
    ];

    public function isGone(): bool
    {
        return $this->to_path === null;
    }

    /**
     * Points `$fromPath` at `$toPath` (null for a 410), resolving the
     * target to its final destination and rewriting every redirect that
     * pointed at `$fromPath`, so visitors never go through a chain. When
     * the target itself redirected back to `$fromPath`, the newest
     * decision wins and the target is served again.
     */
    public static function register(string $fromPath, ?string $toPath): void
    {
        $fromPath = self::normalize($fromPath);
        $targetPath = $toPath === null ? null : self::normalize($toPath);

        DB::transaction(function () use ($fromPath, $targetPath): void {
            if ($targetPath === $fromPath) {
                self::forget($fromPath);

                return;
            }

            $finalPath = $targetPath === null ? null : self::resolve($targetPath);

            if ($finalPath === $fromPath) {
                self::forget($targetPath);
                $finalPath = $targetPath;
            }

            self::query()->updateOrCreate(['from_path' => $fromPath], ['to_path' => $finalPath]);

            self::query()->where('to_path', $fromPath)->update(['to_path' => $finalPath]);

            self::query()->whereColumn('from_path', 'to_path')->delete();
        });

        ResponseCache::forget(url($fromPath));
    }

    /**
     * Called when a page lives again at `$path`: it must not stay redirected.
     */
    public static function forget(string $path): void
    {
        self::query()->where('from_path', self::normalize($path))->delete();
    }

    public static function findForPath(string $path): ?self
    {
        return self::query()->where('from_path', self::normalize($path))->first();
    }

    private static function resolve(string $path): ?string
    {
        $redirect = self::findForPath($path);

        return $redirect ? $redirect->to_path : $path;
    }

    private static function normalize(string $path): string
    {
        $path = parse_url($path, PHP_URL_PATH) ?: '/';

        return $path === '/' ? $path : '/' . trim($path, '/');
    }
}
