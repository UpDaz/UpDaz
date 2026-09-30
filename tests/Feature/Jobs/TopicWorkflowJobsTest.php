<?php

namespace Tests\Feature\Jobs;

use App\Enums\TopicStatus;
use App\Jobs\PrepareInterviewJob;
use App\Jobs\ProposeArticleUpdateJob;
use App\Jobs\ProposeTopicsJob;
use App\Models\Article;
use App\Models\Category;
use App\Models\WeeklyDigest;
use App\Notifications\ArticleUpdateReadyForReview;
use App\Notifications\InterviewReady;
use App\Notifications\TopicsProposed;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use Mockery;
use Prism\Prism\Enums\FinishReason;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Structured\Response as StructuredResponse;
use Prism\Prism\ValueObjects\Meta;
use Prism\Prism\ValueObjects\Usage;
use RuntimeException;
use Tests\TestCase;

class TopicWorkflowJobsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['ai.throttle_seconds' => 0]);

        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();
        Artisan::swap($kernel);
    }

    /**
     * @param  array<string, mixed>  $structured
     */
    private function fakeStructured(array $structured): StructuredResponse
    {
        return new StructuredResponse(
            steps: new Collection(),
            text: '',
            structured: $structured,
            finishReason: FinishReason::Stop,
            usage: new Usage(10, 10),
            meta: new Meta('fake', 'claude-sonnet-5'),
        );
    }

    private function publishedArticle(string $slug): Article
    {
        return Article::factory()->create([
            'slug' => $slug,
            'category_id' => Category::factory()->create()->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);
    }

    public function testProposesThisWeeksTopicsAndFlagsTheOnesAlreadyCovered(): void
    {
        Notification::fake();
        $article = $this->publishedArticle('laravel-13-breaking-changes-nouveautes');

        Prism::fake([
            $this->fakeStructured(['topic_title' => 'Migrer vers Laravel 13.1', 'overlapping_article' => 'laravel-13-breaking-changes-nouveautes']),
            $this->fakeStructured(['topic_title' => 'Lunar 2 : quoi de neuf ?', 'overlapping_article' => 'Aucun']),
        ]);

        $coveredTopic = WeeklyDigest::factory()->create(['week_start' => now()->startOfWeek()]);
        $newTopic = WeeklyDigest::factory()->create(['week_start' => now()->startOfWeek()]);

        (new ProposeTopicsJob())->handle();

        $this->assertSame('Migrer vers Laravel 13.1', $coveredTopic->fresh()->topic_title);
        $this->assertSame($article->id, $coveredTopic->fresh()->overlapping_article_id);
        $this->assertNull($newTopic->fresh()->overlapping_article_id);
        $this->assertNotNull($newTopic->fresh()->proposed_at);

        Notification::assertSentOnDemand(
            TopicsProposed::class,
            fn (TopicsProposed $notification): bool => $notification->digests->count() === 2
        );
    }

    public function testDoesNotProposeTopicsTwice(): void
    {
        Notification::fake();

        WeeklyDigest::factory()->create(['week_start' => now()->startOfWeek(), 'proposed_at' => now()]);

        (new ProposeTopicsJob())->handle();

        Notification::assertNothingSent();
    }

    public function testPreparesTheInterviewQuestions(): void
    {
        Notification::fake();
        Prism::fake([
            $this->fakeStructured(['questions' => [
                'Sur quel projet as-tu rencontré ce problème ?',
                str_repeat('Question trop longue ', 10),
            ]]),
        ]);

        $digest = WeeklyDigest::factory()->create(['status' => TopicStatus::Interviewing]);

        (new PrepareInterviewJob($digest))->handle();

        $digest->refresh();

        $this->assertSame(TopicStatus::Interviewing, $digest->status);
        $this->assertSame('Sur quel projet as-tu rencontré ce problème ?', $digest->interview_questions[0]);
        $this->assertLessThanOrEqual(100, mb_strlen($digest->interview_questions[1]));
        $this->assertNotNull($digest->interview_sent_at);

        Notification::assertSentOnDemand(InterviewReady::class);
    }

    public function testProposesAnUpdateOfTheOverlappingArticle(): void
    {
        Notification::fake();
        $fake = Prism::fake([
            $this->fakeStructured([
                'content' => "## Laravel 13.1\n\nNouveau contenu.",
                'changes_summary' => 'Ajout : section Laravel 13.1',
            ]),
        ]);

        $article = $this->publishedArticle('laravel-13-breaking-changes-nouveautes');
        $article->update(['content' => "## Laravel 13\n\nContenu existant." . WeeklyDigest::SOURCES_SEPARATOR . '- <a href="https://old.test">Ancien</a> — Source']);

        $digest = WeeklyDigest::factory()->create(['overlapping_article_id' => $article->id, 'status' => TopicStatus::Drafting]);

        (new ProposeArticleUpdateJob($digest))->handle();

        $fake->assertRequest(function (array $requests): void {
            $prompt = $requests[0]->prompt();

            $this->assertStringContainsString('Contenu existant.', $prompt);
            $this->assertStringNotContainsString('https://old.test', $prompt);
        });

        $digest->refresh();

        $this->assertSame(TopicStatus::Drafted, $digest->status);
        $this->assertSame('Ajout : section Laravel 13.1', $digest->proposed_update_summary);
        $this->assertStringContainsString('Contenu existant.', $article->fresh()->getRawOriginal('content'));

        Notification::assertSentOnDemand(ArticleUpdateReadyForReview::class);
    }

    public function testAppliedUpdateKeepsExistingSourcesAndAddsNewOnes(): void
    {
        $article = $this->publishedArticle('mon-article');
        $article->update(['content' => 'Ancien contenu.' . WeeklyDigest::SOURCES_SEPARATOR . '- <a href="https://old.test">Ancien</a> — Source']);

        $digest = WeeklyDigest::factory()->create([
            'overlapping_article_id' => $article->id,
            'proposed_update' => 'Contenu enrichi.',
        ]);

        $digest->applyProposedUpdate();

        $content = $article->fresh()->getRawOriginal('content');

        $this->assertStringStartsWith('Contenu enrichi.' . WeeklyDigest::SOURCES_SEPARATOR, $content);
        $this->assertStringContainsString('https://old.test', $content);

        foreach ($digest->rawArticles() as $rawArticle) {
            $this->assertStringContainsString($rawArticle->url, $content);
        }

        $this->assertNull($digest->fresh()->proposed_update);
    }

    public function testAFailedInterviewPreparationLetsTheTopicBeChosenAgain(): void
    {
        Notification::fake();
        Prism::shouldReceive('structured')->andThrow(new RuntimeException('API indisponible'));

        $digest = WeeklyDigest::factory()->create(['status' => TopicStatus::Interviewing]);

        (new PrepareInterviewJob($digest))->handle();

        $this->assertSame(TopicStatus::Proposed, $digest->fresh()->status);
        Notification::assertNothingSent();
    }
}
