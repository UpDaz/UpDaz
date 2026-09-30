<?php

namespace Tests\Feature\Notifications;

use App\Models\Article;
use App\Models\WeeklyDigest;
use App\Notifications\TopicsProposed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Tests\TestCase;

class TopicsProposedTest extends TestCase
{
    use RefreshDatabase;

    public function testOffersAnUpdateOnlyForTopicsAlreadyCovered(): void
    {
        $article = Article::factory()->create(['title' => 'Laravel 13 : ce qui casse']);

        $coveredTopic = WeeklyDigest::factory()->create(['topic_title' => 'Migrer vers Laravel 13.1', 'overlapping_article_id' => $article->id]);
        $newTopic = WeeklyDigest::factory()->create(['topic_title' => 'Lunar 2 : quoi de neuf ?']);

        $message = (new TopicsProposed(WeeklyDigest::query()->with('overlappingArticle')->orderBy('id')->get()))
            ->toDiscord(new AnonymousNotifiable());

        $rows = json_decode(json_encode($message->components), true);

        $this->assertStringContainsString('Migrer vers Laravel 13.1', $message->body);
        $this->assertStringContainsString('Déjà traité par « Laravel 13 : ce qui casse »', $message->body);
        $this->assertSame(
            ["topic:choose:{$coveredTopic->id}", "topic:update:{$coveredTopic->id}"],
            array_column($rows[0]['components'], 'custom_id')
        );
        $this->assertSame(["topic:choose:{$newTopic->id}"], array_column($rows[1]['components'], 'custom_id'));
    }
}
