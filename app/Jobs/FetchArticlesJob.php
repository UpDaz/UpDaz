<?php

namespace App\Jobs;

use App\Enums\SourceType;
use App\Models\RawArticle;
use App\Models\Source;
use DOMDocument;
use DOMXPath;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class FetchArticlesJob implements ShouldQueue
{
    use Queueable;

    private const USER_AGENT = 'Mozilla/5.0 (compatible; UpDazBot/1.0; +https://www.updaz.fr)';

    public function handle(): void
    {
        $sources = Source::where('active', true)->get();

        notice('[FetchArticlesJob] Démarrage', ['sources_actives' => $sources->count()]);

        $created = 0;

        $sources->each(function (Source $source) use (&$created) {
            notice('[FetchArticlesJob] Récupération de la source', [
                'source_id' => $source->id,
                'name' => $source->name,
                'type' => $source->type->value,
                'url' => $source->url,
            ]);

            try {
                $items = match ($source->type) {
                    SourceType::Rss => $this->parseRss($source->url),
                    SourceType::Scraper => $this->scrapePage($source->url),
                };
            } catch (Throwable $e) {
                warning('[FetchArticlesJob] Échec de récupération de la source', [
                    'source_id' => $source->id,
                    'url' => $source->url,
                    'error' => $e->getMessage(),
                ]);

                return;
            }

            debug('[FetchArticlesJob] Articles trouvés sur la source', [
                'source_id' => $source->id,
                'count' => count($items),
            ]);

            foreach ($items as $item) {
                $article = RawArticle::firstOrCreate(
                    ['url' => $item['url']],
                    [
                        'source_id' => $source->id,
                        'title' => $item['title'],
                        'content' => $item['content'],
                        'image_url' => $item['image_url'],
                        'published_at' => $item['published_at'],
                    ]
                );

                if ($article->wasRecentlyCreated) {
                    $created++;

                    debug('[FetchArticlesJob] Nouvel article brut créé', [
                        'raw_article_id' => $article->id,
                        'title' => $article->title,
                        'source_id' => $source->id,
                    ]);
                }
            }
        });

        notice('[FetchArticlesJob] Terminé', ['nouveaux_raw_articles' => $created]);
    }

    private function fetch(string $url): string
    {
        $response = Http::withUserAgent(self::USER_AGENT)->get($url);

        return $response->successful() ? $response->body() : '';
    }

    private function parseRss(string $url): array
    {
        $xml = $this->fetch($url);

        if (empty($xml)) {
            return [];
        }

        libxml_use_internal_errors(true);
        $feed = simplexml_load_string($xml);
        libxml_clear_errors();

        if ($feed === false || ! isset($feed->channel->item)) {
            return [];
        }

        $items = [];
        $limit = config('blog.max_articles_per_source');
        $entries = $limit !== null
            ? array_slice(iterator_to_array($feed->channel->item, false), 0, $limit)
            : $feed->channel->item;

        foreach ($entries as $entry) {
            $page = $this->extractFromPage((string) $entry->link);

            $items[] = [
                'title' => (string) $entry->title,
                'url' => (string) $entry->link,
                'content' => $page['content'],
                'image_url' => $page['image_url'],
                'published_at' => Carbon::parse((string) $entry->pubDate),
            ];
        }

        return $items;
    }

    private function scrapePage(string $url): array
    {
        $html = $this->fetch($url);

        if (empty($html)) {
            return [];
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // évite les warnings sur du HTML imparfait
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $host = parse_url($url, PHP_URL_HOST);

        // Heuristique générique : un lien d'article pointe vers le même
        // domaine, a un chemin avec au moins un sous-niveau, et un texte
        // de lien assez long pour ressembler à un titre.
        $links = [];

        foreach ($xpath->query('//a[@href]') as $anchor) {
            $absoluteUrl = $this->toAbsoluteUrl($anchor->getAttribute('href'), $url);

            if (! $absoluteUrl || parse_url($absoluteUrl, PHP_URL_HOST) !== $host) {
                continue;
            }

            $path = trim(parse_url($absoluteUrl, PHP_URL_PATH) ?? '', '/');

            // `textContent` concatenates every descendant text node: when
            // the anchor wraps a whole "card" (heading, author, tags,
            // date...) instead of just a headline, this yields a huge,
            // whitespace-heavy blob rather than a real title.
            $title = trim(preg_replace('/\s+/', ' ', $anchor->textContent));

            if (substr_count($path, '/') < 1 || strlen($title) < 20) {
                continue;
            }

            $title = Str::limit($title, 200, '');

            $links[$absoluteUrl] = $title;
        }

        $items = [];
        $limit = min(20, config('blog.max_articles_per_source') ?? 20);

        foreach (array_slice($links, 0, $limit, true) as $articleUrl => $title) {
            $page = $this->extractFromPage($articleUrl);

            $items[] = [
                'title' => $title,
                'url' => $articleUrl,
                'content' => $page['content'],
                'image_url' => $page['image_url'],
                'published_at' => null,
            ];
        }

        return $items;
    }

    private function toAbsoluteUrl(string $href, string $baseUrl): ?string
    {
        if (str_starts_with($href, 'http://') || str_starts_with($href, 'https://')) {
            return $href;
        }

        if (str_starts_with($href, '//')) {
            return 'https:' . $href;
        }

        if (str_starts_with($href, '/')) {
            $base = parse_url($baseUrl);

            return ($base['scheme'] ?? 'https') . '://' . ($base['host'] ?? '') . $href;
        }

        return null;
    }

    // private function extractCleanContent(string $url): string
    // {
    //     // Le RSS ne contient souvent qu'un extrait : on va chercher
    //     // le texte complet et on isole l'article avec un extracteur
    //     // de type "readability" (ex: fivefilters/readability.php)
    //     $html = Http::get($url)->body();
    //     $readability = new Readability(new Configuration());
    //     $readability->parse($html);

    //     return strip_tags($readability->getContent());
    // }

    /**
     * @return array{content: string, image_url: ?string}
     */
    private function extractFromPage(string $url): array
    {
        $html = $this->fetch($url);

        if (empty($html)) {
            return ['content' => '', 'image_url' => null];
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // évite les warnings sur du HTML imparfait
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $imageUrl = $this->extractImageUrl($xpath, $url);

        // Supprime le bruit avant de chercher le contenu
        foreach (['script', 'style', 'nav', 'footer', 'aside', 'header', 'form'] as $tag) {
            foreach (iterator_to_array($xpath->query("//{$tag}")) as $node) {
                $node->parentNode->removeChild($node);
            }
        }

        // Cherche d'abord une balise <article>, sinon le conteneur
        // avec le plus de texte cumulé dans ses <p>
        $article = $xpath->query('//article')->item(0);

        if (! $article) {
            $candidates = [];
            foreach ($xpath->query('//div | //main | //section') as $node) {
                $textLength = strlen(trim($node->textContent));
                $paragraphCount = $xpath->query('.//p', $node)->length;
                if ($paragraphCount >= 3) {
                    $candidates[$textLength] = $node;
                }
            }
            if (! empty($candidates)) {
                krsort($candidates);
                $article = reset($candidates);
            }
        }

        $text = $article ? $article->textContent : $dom->textContent;

        return [
            'content' => trim(preg_replace('/\s+/', ' ', $text)),
            'image_url' => $imageUrl,
        ];
    }

    /**
     * Picks the article's representative image: the Open Graph image
     * declared in `<head>` (the de facto standard for a page's "main"
     * image), falling back to the first `<img>` found in the body.
     */
    private function extractImageUrl(DOMXPath $xpath, string $baseUrl): ?string
    {
        $candidates = [
            $xpath->query('//meta[@property="og:image"]/@content')->item(0)?->nodeValue,
            $xpath->query('//article//img/@src')->item(0)?->nodeValue,
            $xpath->query('//img/@src')->item(0)?->nodeValue,
        ];

        foreach ($candidates as $src) {
            if (! $src) {
                continue;
            }

            $absoluteUrl = $this->toAbsoluteUrl($src, $baseUrl);

            if ($absoluteUrl) {
                return $absoluteUrl;
            }
        }

        return null;
    }
}
