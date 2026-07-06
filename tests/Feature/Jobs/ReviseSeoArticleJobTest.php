<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ReviseSeoArticleJob;
use App\Models\Article;
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

class ReviseSeoArticleJobTest extends TestCase
{
    use RefreshDatabase;

    private function articleWithImageAndSources(): Article
    {
        $rawArticle = RawArticle::factory()->create([
            'title' => 'Article source original',
            'url' => 'https://example.com/article-source',
            'image_url' => 'https://example.com/cover.jpg',
        ]);

        $originalContent = "<img src=\"https://example.com/cover.jpg\"
        alt=\"\" loading=\"lazy\"
        onerror=\"this.remove()\">\n\n## Introduction\n\nContenu original";

        $article = Article::factory()->create([
            'title' => 'Titre original',
            'content' =>
                $originalContent . WeeklyDigest::SOURCES_SEPARATOR . "- <a href=\"https://example.com/article-source\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">Article source original</a> — {$rawArticle->source->name}",
            'is_published' => false,
            'generated_by_agent' => true,
        ]);

        WeeklyDigest::factory()->create([
            'post_id' => $article->id,
            'raw_article_ids' => [$rawArticle->id],
        ]);

        return $article;
    }

    private function fakeRevisedResponse(string $content): StructuredResponse
    {
        return new StructuredResponse(
            steps: new Collection(),
            text: '',
            structured: [
                'title' => 'IA générative : titre révisé',
                'catch_phrase' => 'Accroche révisée pour capter l\'attention.',
                'meta_description' => 'Meta description révisée.',
                'slug' => 'ia-generative-titre-revise',
                'content' => $content,
                'tags' => ['ia', 'revision'],
            ],
            finishReason: FinishReason::Stop,
            usage: new Usage(10, 10),
            meta: new Meta('fake', 'claude-sonnet-5'),
        );
    }

    public function testRevisesTheArticleAndSendsANewReviewNotification(): void
    {
        Notification::fake();

        $fake = Prism::fake([
            $this->fakeRevisedResponse("## Introduction revue\n\nContenu révisé."),
        ]);

        $article = $this->articleWithImageAndSources();

        (new ReviseSeoArticleJob($article, 'Rendre le titre plus percutant.'))->handle();

        $article->refresh();

        $this->assertSame('IA générative : titre révisé', $article->title);
        $this->assertSame('Accroche révisée pour capter l\'attention.', $article->catch_phrase);
        $this->assertSame('ia-generative-titre-revise', $article->slug);
        $this->assertSame('Meta description révisée.', $article->meta_description);
        $this->assertSame(['ia', 'revision'], $article->tags);
        $this->assertFalse($article->is_published);

        $rawContent = $article->getRawOriginal('content');
        $this->assertStringContainsString('## Sources', $rawContent);
        $this->assertStringContainsString('href="https://example.com/article-source"', $rawContent);
        $this->assertStringContainsString('target="_blank"', $rawContent);
        $this->assertStringContainsString('rel="nofollow noopener noreferrer"', $rawContent);

        $fake->assertRequest(function (array $requests): void {
            foreach ($requests as $request) {
                $this->assertStringNotContainsString('## Sources', $request->prompt());
            }
        });

        Notification::assertSentOnDemand(DraftReadyForReview::class);
    }

    /**
     * Regression test: images used to be stripped from the prompt and
     * unconditionally re-injected after the AI call, so a request like
     * "supprime la première image" had no effect — the AI never saw
     * the image to remove it, and it got added right back anyway.
     */
    public function testTheAiSeesExistingImagesAndCanActOnFeedbackAboutThem(): void
    {
        Notification::fake();

        $fake = Prism::fake([
            // Simulates the AI honouring "remove the image": its
            // response no longer includes the <img> tag.
            $this->fakeRevisedResponse("## Introduction revue\n\nContenu révisé sans image."),
        ]);

        $article = $this->articleWithImageAndSources();

        (new ReviseSeoArticleJob($article, 'Supprime la première image dans le contenu de l\'article.'))->handle();

        $article->refresh();

        $rawContent = $article->getRawOriginal('content');
        $this->assertStringNotContainsString('<img', $rawContent);

        $fake->assertRequest(function (array $requests): void {
            foreach ($requests as $request) {
                $this->assertStringContainsString('<img src="https://example.com/cover.jpg"', $request->prompt());
            }
        });
    }
}
