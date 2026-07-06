<?php

namespace Tests\Feature\Console;

use App\Models\Article;
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

class ReviseArticleTest extends TestCase
{
    use RefreshDatabase;

    public function testRevisesTheGivenArticleWithTheGivenFeedback(): void
    {
        Notification::fake();

        Prism::fake([
            new StructuredResponse(
                steps: new Collection(),
                text: '',
                structured: [
                    'title' => 'IA générative : titre révisé',
                    'catch_phrase' => 'Accroche révisée.',
                    'meta_description' => 'Meta description révisée.',
                    'slug' => 'ia-generative-titre-revise',
                    'content' => "## Introduction revue\n\nContenu révisé.",
                    'tags' => ['ia', 'revision'],
                ],
                finishReason: FinishReason::Stop,
                usage: new Usage(10, 10),
                meta: new Meta('fake', 'claude-sonnet-5'),
            ),
        ]);

        $article = Article::factory()->create([
            'title' => 'Titre original',
            'content' => 'Contenu original',
        ]);

        $this->artisan('articles:revise', [
            'article' => $article->id,
            'feedback' => 'Rendre le titre plus percutant.',
        ])->assertExitCode(0);

        $article->refresh();

        $this->assertSame('IA générative : titre révisé', $article->title);
        Notification::assertSentOnDemand(DraftReadyForReview::class);
    }

    public function testFailsWhenTheArticleDoesNotExist(): void
    {
        $this->artisan('articles:revise', [
            'article' => 999,
            'feedback' => 'Peu importe.',
        ])->assertExitCode(1);
    }
}
