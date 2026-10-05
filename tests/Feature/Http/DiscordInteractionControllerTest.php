<?php

namespace Tests\Feature\Http;

use App\Enums\TopicStatus;
use App\Models\Article;
use App\Models\Category;
use App\Models\WeeklyDigest;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use Illuminate\Testing\TestResponse;
use Mockery;
use Tests\TestCase;

class DiscordInteractionControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $publicKey;

    private string $privateKey;

    protected function setUp(): void
    {
        parent::setUp();

        $keypair = sodium_crypto_sign_keypair();
        $this->publicKey = sodium_crypto_sign_publickey($keypair);
        $this->privateKey = sodium_crypto_sign_secretkey($keypair);

        config(['services.discord.public_key' => bin2hex($this->publicKey)]);
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{0: array<string, mixed>, 1: array<string, string>}
     */
    private function signedRequest(array $payload): array
    {
        $body = json_encode($payload);
        $timestamp = (string) time();
        $signature = sodium_crypto_sign_detached($timestamp . $body, $this->privateKey);

        return [
            $payload,
            [
                'X-Signature-Ed25519' => bin2hex($signature),
                'X-Signature-Timestamp' => $timestamp,
            ],
        ];
    }

    public function testRejectsRequestsWithoutASignature(): void
    {
        $this->postJson('/discord/interactions', ['type' => 1])
            ->assertUnauthorized();
    }

    public function testRejectsRequestsWithAnInvalidSignature(): void
    {
        [$payload, $headers] = $this->signedRequest(['type' => 1]);
        $headers['X-Signature-Ed25519'] = str_repeat('0', 128);

        $this->postJson('/discord/interactions', $payload, $headers)
            ->assertUnauthorized();
    }

    public function testRespondsToPingWithPong(): void
    {
        [$payload, $headers] = $this->signedRequest(['type' => 1]);

        $this->postJson('/discord/interactions', $payload, $headers)
            ->assertOk()
            ->assertJson(['type' => 1]);
    }

    public function testApproveButtonPublishesTheArticleAndUpdatesTheMessage(): void
    {
        // RefreshDatabase migrates via Artisan::call('migrate') during setUp,
        // which caches the facade's resolved kernel instance, so a plain
        // partialMock() rebind of the container wouldn't be seen by it.
        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->once()->with('sitemap:generate');
        Artisan::swap($kernel);

        $article = Article::factory()->create(['is_published' => false]);

        [$payload, $headers] = $this->signedRequest([
            'type' => 3,
            'data' => ['custom_id' => 'article:approve:' . $article->id],
            'member' => ['user' => ['username' => 'matthieu']],
        ]);

        $response = $this->postJson('/discord/interactions', $payload, $headers)->assertOk();

        $this->assertSame(7, $response->json('type'));
        $this->assertStringContainsString('matthieu', $response->json('data.content'));
        $this->assertSame([], $response->json('data.components'));

        $article->refresh();
        $this->assertTrue($article->is_published);
        $this->assertNotNull($article->published_at);
    }

    public function testReviseButtonRespondsWithAModal(): void
    {
        $article = Article::factory()->create();

        [$payload, $headers] = $this->signedRequest([
            'type' => 3,
            'data' => ['custom_id' => 'article:revise:' . $article->id],
        ]);

        $response = $this->postJson('/discord/interactions', $payload, $headers)->assertOk();

        $this->assertSame(9, $response->json('type'));
        $this->assertSame('article_revise_modal:' . $article->id, $response->json('data.custom_id'));
    }

    public function testModalSubmitStartsARevisionInTheBackground(): void
    {
        Process::fake();

        $article = Article::factory()->create();

        [$payload, $headers] = $this->signedRequest([
            'type' => 5,
            'data' => [
                'custom_id' => 'article_revise_modal:' . $article->id,
                'components' => [
                    [
                        'type' => 1,
                        'components' => [
                            ['type' => 4, 'custom_id' => 'feedback', 'value' => 'Rendre le titre plus percutant.'],
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->postJson('/discord/interactions', $payload, $headers)->assertOk();

        $this->assertSame(4, $response->json('type'));
        $this->assertSame(64, $response->json('data.flags'));

        $this->assertArtisanRanInBackground(['articles:revise', (string) $article->id, 'Rendre le titre plus percutant.']);
    }

    public function testRespondsWithAnErrorMessageWhenTheArticleIsMissing(): void
    {
        [$payload, $headers] = $this->signedRequest([
            'type' => 3,
            'data' => ['custom_id' => 'article:approve:999999'],
        ]);

        $response = $this->postJson('/discord/interactions', $payload, $headers)->assertOk();

        $this->assertSame(4, $response->json('type'));
        $this->assertStringContainsString('introuvable', $response->json('data.content'));
    }

    public function testChoosingATopicStartsTheInterviewInTheBackground(): void
    {
        Process::fake();

        $digest = WeeklyDigest::factory()->create(['status' => TopicStatus::Proposed]);

        $response = $this->interact(3, "topic:choose:{$digest->id}");

        $this->assertSame(64, $response->json('data.flags'));
        $this->assertSame(TopicStatus::Interviewing, $digest->fresh()->status);

        $this->assertArtisanRanInBackground(['blog:topic', 'prepare-interview', (string) $digest->id]);
    }

    public function testATopicCannotBeChosenTwice(): void
    {
        Process::fake();

        $digest = WeeklyDigest::factory()->create(['status' => TopicStatus::Interviewing]);

        $response = $this->interact(3, "topic:choose:{$digest->id}");

        $this->assertStringContainsString('déjà été choisi', $response->json('data.content'));
        Process::assertNothingRan();
    }

    public function testUpdatingFromATopicPreparesTheUpdateInTheBackground(): void
    {
        Process::fake();

        $digest = WeeklyDigest::factory()->create([
            'status' => TopicStatus::Proposed,
            'overlapping_article_id' => Article::factory()->create()->id,
        ]);

        $this->interact(3, "topic:update:{$digest->id}");

        $this->assertSame(TopicStatus::Drafting, $digest->fresh()->status);
        $this->assertArtisanRanInBackground(['blog:topic', 'propose-update', (string) $digest->id]);
    }

    public function testAnswerButtonOpensAModalWithOneFieldPerQuestion(): void
    {
        $digest = WeeklyDigest::factory()->create([
            'status' => TopicStatus::Interviewing,
            'interview_questions' => ['Quel projet ?', 'Quelle durée ?'],
        ]);

        $response = $this->interact(3, "topic:answer:{$digest->id}");

        $this->assertSame(9, $response->json('type'));
        $this->assertSame("topic_answers_modal:{$digest->id}", $response->json('data.custom_id'));
        $this->assertCount(2, $response->json('data.components'));
        $this->assertSame('Quelle durée ?', $response->json('data.components.1.components.0.placeholder'));
    }

    public function testSubmittedAnswersAreStoredAndTheDraftIsWritten(): void
    {
        Process::fake();

        $digest = WeeklyDigest::factory()->create([
            'status' => TopicStatus::Interviewing,
            'interview_questions' => ['Quel projet ?', 'Quelle durée ?'],
        ]);

        $response = $this->interact(5, "topic_answers_modal:{$digest->id}", [
            ['type' => 1, 'components' => [['type' => 4, 'custom_id' => 'answer_0', 'value' => ' Une reprise Laravel 8. ']]],
            ['type' => 1, 'components' => [['type' => 4, 'custom_id' => 'answer_1', 'value' => '']]],
        ]);

        $this->assertSame(7, $response->json('type'));

        $digest->refresh();
        $this->assertSame(['Une reprise Laravel 8.', ''], $digest->interview_answers);
        $this->assertSame(TopicStatus::Drafting, $digest->status);

        $this->assertArtisanRanInBackground(['blog:topic', 'draft', (string) $digest->id]);
    }

    public function testSkippingTheInterviewWritesAWatchArticle(): void
    {
        Process::fake();

        $digest = WeeklyDigest::factory()->create(['status' => TopicStatus::Interviewing]);

        $response = $this->interact(3, "topic:skip:{$digest->id}");

        $this->assertSame(7, $response->json('type'));
        $this->assertArtisanRanInBackground(['blog:topic', 'draft', (string) $digest->id]);
    }

    public function testApprovingAsFieldExperienceAttachesTheLabelAndRemovesTheOtherOne(): void
    {
        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();
        Artisan::swap($kernel);

        $watch = Category::factory()->create(['slug' => Category::WATCH_SLUG, 'name' => 'Veille']);
        $fieldExperience = Category::factory()->create(['slug' => Category::FIELD_EXPERIENCE_SLUG, 'name' => 'Retour d\'expérience']);

        $article = Article::factory()->create(['category_id' => Category::factory()->create()->id, 'is_published' => false]);
        $article->categories()->attach($watch);

        $response = $this->interact(3, "article:approve-experience:{$article->id}");

        $this->assertStringContainsString('Retour d\'expérience', $response->json('data.content'));

        $labelIds = $article->categories()->whereIn('slug', Category::LABEL_SLUGS)->pluck('categories.id')->all();
        $this->assertSame([$fieldExperience->id], $labelIds);
        $this->assertTrue($article->fresh()->is_published);
    }

    public function testApplyingAnUpdateWritesItIntoTheArticle(): void
    {
        $article = Article::factory()->create(['content' => 'Ancien contenu.']);
        $digest = WeeklyDigest::factory()->create([
            'status' => TopicStatus::Drafted,
            'overlapping_article_id' => $article->id,
            'proposed_update' => 'Contenu enrichi.',
        ]);

        $response = $this->interact(3, "topic:apply-update:{$digest->id}");

        $this->assertSame(7, $response->json('type'));
        $this->assertStringStartsWith('Contenu enrichi.', $article->fresh()->getRawOriginal('content'));
    }

    public function testRejectingAnUpdateLeavesTheArticleUntouched(): void
    {
        $article = Article::factory()->create(['content' => 'Ancien contenu.']);
        $digest = WeeklyDigest::factory()->create([
            'status' => TopicStatus::Drafted,
            'overlapping_article_id' => $article->id,
            'proposed_update' => 'Contenu enrichi.',
        ]);

        $this->interact(3, "topic:reject-update:{$digest->id}");

        $this->assertSame('Ancien contenu.', $article->fresh()->getRawOriginal('content'));
        $this->assertSame(TopicStatus::Expired, $digest->fresh()->status);
        $this->assertNull($digest->fresh()->proposed_update);
    }

    /**
     * @param  array<int, array<string, mixed>>  $components
     */
    private function interact(int $type, string $customId, array $components = []): TestResponse
    {
        [$payload, $headers] = $this->signedRequest([
            'type' => $type,
            'data' => array_filter(['custom_id' => $customId, 'components' => $components]),
            'member' => ['user' => ['username' => 'matthieu']],
        ]);

        return $this->postJson('/discord/interactions', $payload, $headers)->assertOk();
    }

    /**
     * @param  array<int, string>  $arguments
     */
    private function assertArtisanRanInBackground(array $arguments): void
    {
        $expected = collect(['artisan', ...$arguments])
            ->map(fn (string $argument): string => escapeshellarg($argument))
            ->implode(' ');

        Process::assertRan(fn ($process) => str_starts_with($process->command, 'nohup ')
            && str_contains($process->command, " {$expected} >> ")
            && str_ends_with($process->command, ' 2>&1 &'));
    }
}
