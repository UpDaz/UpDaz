<?php

namespace Tests\Feature\Jobs;

use App\Jobs\GenerateSeoArticleJob;
use App\Models\Article;
use App\Models\Category;
use App\Models\RawArticle;
use App\Models\WeeklyDigest;
use App\Notifications\DraftReadyForReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Prism\Prism\Enums\FinishReason;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Structured\Response as StructuredResponse;
use Prism\Prism\ValueObjects\Meta;
use Prism\Prism\ValueObjects\Usage;
use Tests\TestCase;

class GenerateSeoArticleJobTest extends TestCase
{
    use RefreshDatabase;

    private function fakeArticle(): StructuredResponse
    {
        return new StructuredResponse(
            steps: new Collection(),
            text: '',
            structured: [
                'title' => 'IA générative : ce qu\'il faut retenir',
                'catch_phrase' => 'Un tour d\'horizon des nouveautés qui comptent cette semaine.',
                'meta_description' => 'Un tour d\'horizon des tendances IA générative de la semaine.',
                'slug' => 'ia-generative-ce-quil-faut-retenir',
                'content' => "## Introduction\n\nContenu généré.",
                'tags' => ['ia', 'llm', 'agent'],
            ],
            finishReason: FinishReason::Stop,
            usage: new Usage(10, 10),
            meta: new Meta('fake', 'claude-sonnet-5'),
        );
    }

    public function testGeneratesADraftArticleFromDigestsOfTheCurrentWeek(): void
    {
        Notification::fake();
        Prism::fake([$this->fakeArticle()]);

        $category = Category::factory()->create(['name' => 'Intelligence Artificielle']);

        $digest = WeeklyDigest::factory()->create([
            'week_start' => now()->startOfWeek(),
            'post_id' => null,
            'theme' => 'Intelligence Artificielle',
            'summary' => 'Synthèse de la semaine sur l\'IA générative.',
        ]);

        (new GenerateSeoArticleJob())->handle();

        $digest->refresh();

        $this->assertNotNull($digest->post_id);

        $article = Article::find($digest->post_id);

        $this->assertNotNull($article);
        $this->assertSame('IA générative : ce qu\'il faut retenir', $article->title);
        $this->assertSame('Un tour d\'horizon des nouveautés qui comptent cette semaine.', $article->catch_phrase);
        $this->assertSame('ia-generative-ce-quil-faut-retenir', $article->slug);
        $this->assertSame('Un tour d\'horizon des tendances IA générative de la semaine.', $article->meta_description);
        $this->assertSame(['ia', 'llm', 'agent'], $article->tags);
        $this->assertSame($category->id, $article->category_id);
        $this->assertFalse($article->is_published);
        $this->assertTrue($article->generated_by_agent);

        $rawContent = $article->getRawOriginal('content');
        $this->assertStringContainsString('## Sources', $rawContent);

        foreach ($digest->rawArticles() as $rawArticle) {
            $this->assertStringContainsString("href=\"{$rawArticle->url}\"", $rawContent);
            $this->assertStringContainsString(">{$rawArticle->title}<", $rawContent);
        }

        $this->assertStringContainsString('target="_blank"', $rawContent);
        $this->assertStringContainsString('rel="nofollow noopener noreferrer"', $rawContent);

        Notification::assertSentOnDemand(DraftReadyForReview::class);
    }

    public function testInjectsASourceImageBeforeGeneratedHeadings(): void
    {
        Notification::fake();
        Prism::fake([$this->fakeArticle()]);

        $rawArticle = RawArticle::factory()->create(['image_url' => 'https://example.com/cover.jpg']);

        $digest = WeeklyDigest::factory()->create([
            'week_start' => now()->startOfWeek(),
            'post_id' => null,
            'raw_article_ids' => [$rawArticle->id],
        ]);

        (new GenerateSeoArticleJob())->handle();

        $digest->refresh();
        $article = Article::find($digest->post_id);
        $rawContent = $article->getRawOriginal('content');

        $this->assertStringContainsString(
            "<img src=\"https://example.com/cover.jpg\" alt=\"\" loading=\"lazy\" onerror=\"this.remove()\">\n\n## Introduction",
            $rawContent
        );
        $this->assertStringNotContainsString('onerror="this.remove()">' . "\n\n" . '## Sources', $rawContent);
    }

    public function testLeavesCategoryNullWhenNoCategoryMatchesTheDigestTheme(): void
    {
        Notification::fake();
        Prism::fake([$this->fakeArticle()]);

        $digest = WeeklyDigest::factory()->create([
            'week_start' => now()->startOfWeek(),
            'post_id' => null,
            'theme' => 'Thème sans catégorie correspondante',
        ]);

        (new GenerateSeoArticleJob())->handle();

        $digest->refresh();
        $article = Article::find($digest->post_id);

        $this->assertNull($article->category_id);
    }

    public function testIgnoresDigestsThatAlreadyHaveAPost(): void
    {
        Notification::fake();

        $article = Article::factory()->create();
        WeeklyDigest::factory()->create([
            'week_start' => now()->startOfWeek(),
            'post_id' => $article->id,
        ]);

        (new GenerateSeoArticleJob())->handle();

        Notification::assertNothingSent();
    }

    public function testIgnoresDigestsFromPreviousWeeks(): void
    {
        Notification::fake();

        WeeklyDigest::factory()->create([
            'week_start' => now()->subWeek()->startOfWeek(),
            'post_id' => null,
        ]);

        (new GenerateSeoArticleJob())->handle();

        Notification::assertNothingSent();
    }
}
