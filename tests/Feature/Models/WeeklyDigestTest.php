<?php

namespace Tests\Feature\Models;

use App\Models\RawArticle;
use App\Models\Source;
use App\Models\WeeklyDigest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeeklyDigestTest extends TestCase
{
    use RefreshDatabase;

    public function testSourcesMarkdownStripsHtmlTagsFromTitleAndSourceName(): void
    {
        $source = Source::factory()->create(['name' => '<b>Korben</b>']);

        $rawArticle = RawArticle::factory()->create([
            'source_id' => $source->id,
            'title' => 'Comment utiliser <code>Laravel</code> & Filament',
            'url' => 'https://example.com/article',
        ]);

        $digest = WeeklyDigest::factory()->create([
            'raw_article_ids' => [$rawArticle->id],
        ]);

        $markdown = $digest->sourcesMarkdown();

        $this->assertStringContainsString('>Comment utiliser Laravel &amp; Filament</a>', $markdown);
        $this->assertStringContainsString('— Korben', $markdown);
        $this->assertStringNotContainsString('<code>', $markdown);
        $this->assertStringNotContainsString('<b>Korben</b>', $markdown);
    }

    public function testSourcesMarkdownCollapsesWhitespaceAndBoundsTheLengthOfMessyTitles(): void
    {
        // Reproduces a real scraper bug: the anchor's textContent picked up
        // a whole listing "card" (heading, author, tags, date...) instead
        // of just the headline, yielding a huge whitespace-heavy blob.
        $messyTitle = "Help make Filament faster!\n            \n        \n\n        "
            . str_repeat("\n            \n    \n\n        \n    ", 20)
            . 'Author: Alex Six';

        $rawArticle = RawArticle::factory()->create([
            'title' => $messyTitle,
            'url' => 'https://example.com/article',
        ]);

        $digest = WeeklyDigest::factory()->create([
            'raw_article_ids' => [$rawArticle->id],
        ]);

        $markdown = $digest->sourcesMarkdown();

        preg_match('/<a[^>]*>([^<]*)<\/a>/', $markdown, $matches);
        $linkText = $matches[1] ?? null;

        $this->assertNotNull($linkText);
        $this->assertStringNotContainsString("\n", $linkText);
        $this->assertLessThanOrEqual(153, mb_strlen($linkText));
        $this->assertStringStartsWith('Help make Filament faster!', $linkText);
    }

    public function testSourcesMarkdownIsEmptyWhenNoRawArticles(): void
    {
        $digest = WeeklyDigest::factory()->create(['raw_article_ids' => []]);

        $this->assertSame('', $digest->sourcesMarkdown());
    }

    public function testInjectSourceImagesInsertsOneImagePerHeadingUntilImagesRunOut(): void
    {
        $rawArticles = RawArticle::factory()->count(3)->sequence(
            ['image_url' => 'https://example.com/one.jpg'],
            ['image_url' => null],
            ['image_url' => 'https://example.com/two.jpg'],
        )->create();

        $digest = WeeklyDigest::factory()->create([
            'raw_article_ids' => $rawArticles->pluck('id')->all(),
        ]);

        $markdown = <<<'MARKDOWN'
        Intro sans titre.

        ## Premier titre

        Texte.

        ## Deuxième titre

        Texte.

        ## Troisième titre

        Texte.
        MARKDOWN;

        $result = $digest->injectSourceImages($markdown);

        $this->assertStringContainsString(
            "<img src=\"https://example.com/one.jpg\" alt=\"\" loading=\"lazy\" onerror=\"this.remove()\">\n\n## Premier titre",
            $result
        );
        $this->assertStringContainsString(
            "<img src=\"https://example.com/two.jpg\" alt=\"\" loading=\"lazy\" onerror=\"this.remove()\">\n\n## Deuxième titre",
            $result
        );
        $this->assertStringNotContainsString('onerror="this.remove()">' . "\n\n" . '## Troisième titre', $result);
    }

    public function testInjectSourceImagesLeavesMarkdownUnchangedWhenNoImageAvailable(): void
    {
        $rawArticle = RawArticle::factory()->create(['image_url' => null]);

        $digest = WeeklyDigest::factory()->create([
            'raw_article_ids' => [$rawArticle->id],
        ]);

        $markdown = "## Un titre\n\nTexte.";

        $this->assertSame($markdown, $digest->injectSourceImages($markdown));
    }
}
