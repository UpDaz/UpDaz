<?php

namespace Tests\Feature\Http;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Process;
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

        Process::assertRan(fn ($process) => $process->command === [
            PHP_BINARY,
            'artisan',
            'articles:revise',
            (string) $article->id,
            'Rendre le titre plus percutant.',
        ]);
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
}
