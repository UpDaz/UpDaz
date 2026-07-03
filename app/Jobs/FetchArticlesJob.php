<?php

namespace App\Jobs;

use App\Models\RawArticle;
use App\Models\Source;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class FetchArticlesJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        Source::where('active', true)->each(function (Source $source) {
            $items = match ($source->type) {
                'rss' => $this->parseRss($source->url),
                'scraper' => $this->scrapePage($source->url),
            };

            foreach ($items as $item) {
                RawArticle::firstOrCreate(
                    ['url' => $item['url']],
                    [
                        'source_id' => $source->id,
                        'title' => $item['title'],
                        'content' => $item['content'],
                        'published_at' => $item['published_at'],
                    ]
                );
            }
        });
    }

    private function parseRss(string $url): array
    {
        $xml = Http::get($url)->body();
        $feed = new SimpleXMLElement($xml);
        $items = [];

        foreach ($feed->channel->item as $entry) {
            $items[] = [
                'title' => (string) $entry->title,
                'url' => (string) $entry->link,
                'content' => $this->extractFromPage((string) $entry->link),
                'published_at' => Carbon::parse((string) $entry->pubDate),
            ];
        }

        return $items;
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

    private function extractFromPage(string $url): string
    {
        $html = Http::get($url)->body();
        if (empty($html)) {
            return '';
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // évite les warnings sur du HTML imparfait
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

    // Supprime le bruit avant de chercher le contenu
        foreach (['script', 'style', 'nav', 'footer', 'aside', 'header', 'form'] as $tag) {
            foreach (iterator_to_array($xpath->query("//{$tag}")) as $node) {
                $node->parentNode->removeChild($node);
            }
        }

    // Cherche d'abord une balise <article>, sinon le conteneur
    // avec le plus de texte cumulé dans ses <p>
        $article = $xpath->query('//article')->item(0);

        if (!$article) {
            $candidates = [];
            foreach ($xpath->query('//div | //main | //section') as $node) {
                $textLength = strlen(trim($node->textContent));
                $paragraphCount = $xpath->query('.//p', $node)->length;
                if ($paragraphCount >= 3) {
                    $candidates[$textLength] = $node;
                }
            }
            if (!empty($candidates)) {
                krsort($candidates);
                $article = reset($candidates);
            }
        }

        $text = $article ? $article->textContent : $dom->textContent;

        return trim(preg_replace('/\s+/', ' ', $text));
    }
}
