<?php

namespace Tests\Feature\Console;

use App\Console\Commands\DiscordBotServe;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;
use ReflectionMethod;
use Tests\TestCase;

class DiscordBotServeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only the lock guard and the feedback extraction are safely
     * testable here: the rest of `handle()` opens a real Discord
     * gateway connection and blocks forever, which isn't something a
     * feature test can exercise.
     */
    public function testDoesNothingWhenAnInstanceIsAlreadyRunning(): void
    {
        Cache::put('discord-bot-serve-running', true, now()->addDay());

        $this->artisan('discord:serve')->assertExitCode(0);

        $this->assertTrue(Cache::has('discord-bot-serve-running'));
    }

    /**
     * We parse the modal's raw `data->components` ourselves rather
     * than relying on `Interaction::createListener()`'s flattened
     * collection: as of discord-php v10.51.0, its flattening pushes an
     * undefined `$component` variable instead of `$container->component`
     * for Label-wrapped fields (our case), so the real TextInput never
     * reaches it. This covers the shape our modal actually submits.
     */
    public function testFindFeedbackValueFindsTheFieldInsideALabelContainer(): void
    {
        $containers = [
            (object) [
                'type' => 18, // Label
                'component' => (object) ['custom_id' => 'feedback', 'value' => 'Rendre le titre plus percutant.'],
            ],
        ];

        $feedback = (new ReflectionMethod(DiscordBotServe::class, 'findFeedbackValue'))
            ->invoke(new DiscordBotServe(), $containers);

        $this->assertSame('Rendre le titre plus percutant.', $feedback);
    }

    /**
     * Also covers the classic ActionRow-wrapped layout, in case a
     * future modal (or a library fix) uses it instead of Label.
     */
    public function testFindFeedbackValueFindsTheFieldInsideAnActionRowContainer(): void
    {
        $containers = [
            (object) [
                'type' => 1, // ActionRow
                'components' => [
                    (object) ['custom_id' => 'something_else', 'value' => 'ignored'],
                    (object) ['custom_id' => 'feedback', 'value' => 'Rendre le titre plus percutant.'],
                ],
            ],
        ];

        $feedback = (new ReflectionMethod(DiscordBotServe::class, 'findFeedbackValue'))
            ->invoke(new DiscordBotServe(), $containers);

        $this->assertSame('Rendre le titre plus percutant.', $feedback);
    }

    public function testFindFeedbackValueReturnsNullWhenTheFieldIsMissing(): void
    {
        $containers = [
            (object) [
                'type' => 18,
                'component' => (object) ['custom_id' => 'something_else', 'value' => 'ignored'],
            ],
        ];

        $feedback = (new ReflectionMethod(DiscordBotServe::class, 'findFeedbackValue'))
            ->invoke(new DiscordBotServe(), $containers);

        $this->assertNull($feedback);
    }

    /**
     * Exact shape captured from a live Discord modal submission: a
     * collection keyed by each component's `id` (not a plain 0-indexed
     * list), which is why `extractFeedback()` round-trips it through
     * JSON before recursing — plain stdClass/array data of a known
     * shape, no ambiguity about Collection/Part iteration behaviour.
     */
    public function testFindFeedbackValueHandlesTheRealDiscordPayloadShape(): void
    {
        $raw = '{"1":{"type":1,"id":1,"components":{"2":{"type":4,"id":2,"custom_id":"feedback","style":null,"label":null,"min_length":null,"max_length":null,"required":null,"value":"test","placeholder":null}}}}';

        $containers = (array) json_decode($raw);

        $feedback = (new ReflectionMethod(DiscordBotServe::class, 'findFeedbackValue'))
            ->invoke(new DiscordBotServe(), $containers);

        $this->assertSame('test', $feedback);
    }

    /**
     * The revision must run in its own process rather than being
     * dispatched synchronously — see `runRevisionInBackground()`'s
     * docblock for why that used to break the Discord modal.
     */
    public function testRunRevisionInBackgroundSpawnsADedicatedArtisanProcess(): void
    {
        Process::fake();

        $article = Article::factory()->create();

        (new ReflectionMethod(DiscordBotServe::class, 'runRevisionInBackground'))
            ->invoke(new DiscordBotServe(), $article, 'Rendre le titre plus percutant.');

        Process::assertRan(function ($process) use ($article) {
            return $process->command === [
                PHP_BINARY,
                'artisan',
                'articles:revise',
                (string) $article->id,
                'Rendre le titre plus percutant.',
            ];
        });
    }
}
