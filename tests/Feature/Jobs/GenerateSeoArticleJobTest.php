<?php

namespace Tests\Feature\Jobs;

use App\Jobs\GenerateSeoArticleJob;
use App\Models\Article;
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

        $digest = WeeklyDigest::factory()->create([
            'week_start' => now()->startOfWeek(),
            'post_id' => null,
            'summary' => 'Synthèse de la semaine sur l\'IA générative.',
        ]);

        (new GenerateSeoArticleJob())->handle();

        $digest->refresh();

        $this->assertNotNull($digest->post_id);

        $article = Article::find($digest->post_id);

        $this->assertNotNull($article);
        $this->assertSame('IA générative : ce qu\'il faut retenir', $article->title);
        $this->assertSame('ia-generative-ce-quil-faut-retenir', $article->slug);
        $this->assertSame('Un tour d\'horizon des tendances IA générative de la semaine.', $article->meta_description);
        $this->assertSame(['ia', 'llm', 'agent'], $article->tags);
        $this->assertFalse($article->is_published);
        $this->assertTrue($article->generated_by_agent);

        Notification::assertSentOnDemand(DraftReadyForReview::class);
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
