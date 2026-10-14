<?php

namespace Tests\Feature\Casts;

use App\Casts\Markdown;
use App\Models\Article;
use Tests\TestCase;

class MarkdownTest extends TestCase
{
    private function render(string $markdown): string
    {
        return (new Markdown())->get(new Article(), 'content', $markdown, []);
    }

    public function testLocalImageIsServedAsSizedWebpWhenASiblingExists(): void
    {
        $html = $this->render('![Accueil](public_img_path/articles/nouveau-site-le5eme/mockup-accueil.png)');

        $this->assertStringContainsString('mockup-accueil.webp"', $html);
        $this->assertMatchesRegularExpression('/<img width="\d+" height="\d+"/', $html);
    }

    public function testEveryImageButTheFirstIsLazyLoaded(): void
    {
        $html = $this->render("![Un](https://example.com/un.png)\n\n![Deux](https://example.com/deux.png)");

        $this->assertSame(1, substr_count($html, 'loading="lazy"'));
        $this->assertMatchesRegularExpression('/<img loading="lazy" decoding="async" src="https:\/\/example.com\/deux.png"/', $html);
    }

    public function testImageWithoutWebpSiblingKeepsItsOriginalSource(): void
    {
        $html = $this->render('![Démo](public_img_path/articles/asphodele-creation-webflow/asphodele-creations-site.gif)');

        $this->assertStringContainsString('asphodele-creations-site.gif"', $html);
        $this->assertStringContainsString('width="1280" height="720"', $html);
    }
}
