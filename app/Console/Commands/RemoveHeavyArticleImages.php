<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\RemoteImageInspector;
use Illuminate\Console\Command;

class RemoveHeavyArticleImages extends Command
{
    /**
     * HTML `<img>` tags (injected by the pipeline) and Markdown images,
     * each followed by the blank lines that came with it.
     */
    private const IMAGE_PATTERN = '/(?:<img\s[^>]*src="(?<html>https?:\/\/[^"]+)"[^>]*>|!\[[^\]]*\]\((?<markdown>https?:\/\/[^)\s]+)[^)]*\))\n*/i';

    protected $signature = 'articles:remove-heavy-images {--dry-run : Liste les images écartées sans modifier les articles}';

    protected $description = 'Removes third-party images that are too heavy or unreachable from article contents.';

    public function handle(RemoteImageInspector $inspector): int
    {
        $ownHost = parse_url(config('app.url'), PHP_URL_HOST);
        $removedCount = 0;

        Article::query()->orderBy('id')->each(function (Article $article) use ($inspector, $ownHost, &$removedCount): void {
            $content = (string) $article->getRawOriginal('content');

            $cleanedContent = preg_replace_callback(self::IMAGE_PATTERN, function (array $matches) use ($inspector, $ownHost, $article, &$removedCount): string {
                $url = ($matches['html'] ?? '') !== '' ? $matches['html'] : $matches['markdown'];

                if (parse_url($url, PHP_URL_HOST) === $ownHost) {
                    return $matches[0];
                }

                if ($inspector->isEmbeddable($url)) {
                    return $matches[0];
                }

                $this->line("Article #{$article->id} ({$article->slug}) : image écartée {$url}");
                $removedCount++;

                return '';
            }, $content);

            if ($cleanedContent === $content || $this->option('dry-run')) {
                return;
            }

            $article->update(['content' => $cleanedContent]);
        });

        $this->comment($this->option('dry-run')
            ? "{$removedCount} image(s) seraient retirées (simulation, aucun article modifié)."
            : "{$removedCount} image(s) retirées.");

        return self::SUCCESS;
    }
}
