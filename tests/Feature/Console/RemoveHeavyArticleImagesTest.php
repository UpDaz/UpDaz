<?php

namespace Tests\Feature\Console;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RemoveHeavyArticleImagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['blog.max_image_kilobytes' => 300, 'app.url' => 'https://www.updaz.fr']);

        Http::fake([
            'heavy.test/*' => Http::response('', 200, ['Content-Type' => 'image/png', 'Content-Length' => 2 * 1024 * 1024]),
            'light.test/*' => Http::response('', 200, ['Content-Type' => 'image/webp', 'Content-Length' => 50 * 1024]),
        ]);
    }

    private function articleWithImages(): Article
    {
        return Article::factory()->create(['content' => implode("\n\n", [
            '<img src="https://heavy.test/a.png" alt="" loading="lazy" onerror="this.remove()">',
            '## Titre',
            '![Schéma](https://light.test/b.webp)',
            '![Lourde](https://heavy.test/c.png)',
            '![Locale](https://www.updaz.fr/img/d.png)',
            'Fin.',
        ])]);
    }

    public function testRemovesOnlyHeavyThirdPartyImages(): void
    {
        $article = $this->articleWithImages();

        $this->artisan('articles:remove-heavy-images')->assertExitCode(0);

        $content = $article->fresh()->getRawOriginal('content');

        $this->assertStringNotContainsString('heavy.test', $content);
        $this->assertStringContainsString('https://light.test/b.webp', $content);
        $this->assertStringContainsString('https://www.updaz.fr/img/d.png', $content);
        $this->assertStringStartsWith('## Titre', $content);
    }

    public function testDryRunLeavesArticlesUntouched(): void
    {
        $article = $this->articleWithImages();
        $originalContent = $article->getRawOriginal('content');

        $this->artisan('articles:remove-heavy-images', ['--dry-run' => true])
            ->expectsOutputToContain('2 image(s) seraient retirées')
            ->assertExitCode(0);

        $this->assertSame($originalContent, $article->fresh()->getRawOriginal('content'));
    }
}
