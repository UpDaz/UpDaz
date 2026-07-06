<?php

namespace Tests\Feature\Notifications;

use App\Models\Article;
use App\Notifications\DraftReadyForReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use NotificationChannels\Discord\DiscordChannel;
use Tests\TestCase;

class DraftReadyForReviewTest extends TestCase
{
    use RefreshDatabase;

    public function testDiscordMessageContainsApproveAndReviseButtons(): void
    {
        $article = Article::factory()->create(['title' => 'Mon article de test']);

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->assertStringContainsString('Mon article de test', $message->body);
        $this->assertCount(1, $message->components);

        $components = json_decode(json_encode($message->components), true);
        $buttons = $components[0]['components'];

        $this->assertCount(2, $buttons);
        $this->assertSame('article:approve:' . $article->id, $buttons[0]['custom_id']);
        $this->assertSame('article:revise:' . $article->id, $buttons[1]['custom_id']);
    }

    public function testDiscordMessageEmbedContainsTheArticleContent(): void
    {
        $article = Article::factory()->create([
            'title' => 'Mon article de test',
            'content' => "# Introduction\n\nCeci est le contenu markdown de l'article.",
            'meta_description' => 'Une meta description de test.',
            'tags' => ['laravel', 'ia'],
        ]);

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->assertSame('Mon article de test', $message->embed['title']);
        $this->assertStringContainsString("Ceci est le contenu markdown de l'article.", $message->embed['description']);
        $this->assertSame('Une meta description de test.', $message->embed['fields'][0]['value']);
        $this->assertSame('laravel, ia', $message->embed['fields'][1]['value']);
    }

    public function testDiscordMessageTruncatesLongContentWithLinkToTheFullVersion(): void
    {
        $article = Article::factory()->create([
            'content' => str_repeat('Paragraphe très long. ', 500),
        ]);

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->assertLessThanOrEqual(4096, mb_strlen($message->embed['description']));
        $this->assertStringContainsString('voir la version complète', $message->embed['description']);
    }

    public function testViaOnlyUsesDiscord(): void
    {
        $article = Article::factory()->create();

        $notification = new DraftReadyForReview($article);

        $this->assertSame([DiscordChannel::class], $notification->via(new AnonymousNotifiable()));
    }

    public function testEmbedLinksToASignedPreviewAndKeepsTheAdminEditLinkAsAField(): void
    {
        $article = Article::factory()->create();

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->assertStringContainsString('/articles/preview/' . $article->id, $message->embed['url']);
        $this->assertStringContainsString('signature=', $message->embed['url']);

        $editField = collect($message->embed['fields'])->firstWhere('name', 'Édition (admin)');
        $this->assertNotNull($editField);
        $this->assertStringContainsString('/admin/', $editField['value']);
    }

    public function testPreviewLinkGrantsDedicatedAccessToTheUnpublishedArticle(): void
    {
        $article = Article::factory()->create([
            'title' => 'Brouillon non publié',
            'is_published' => false,
        ]);

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->get($message->embed['url'])
            ->assertOk()
            ->assertSee('Brouillon non publié');
    }

    public function testPreviewRouteRejectsAnUnsignedUrl(): void
    {
        $article = Article::factory()->create(['is_published' => false]);

        $this->get(route('articles.preview', ['article' => $article->id]))
            ->assertForbidden();
    }

    public function testInjectedSourceImageBecomesTheEmbedImageAndIsStrippedFromTheDescription(): void
    {
        $article = Article::factory()->create([
            'content' => "<img src=\"https://example.com/cover.jpg\" alt=\"\" loading=\"lazy\" onerror=\"this.remove()\">\n\n## Introduction\n\nTexte de l'article.",
        ]);

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->assertSame('https://example.com/cover.jpg', $message->embed['image']['url']);
        $this->assertStringNotContainsString('<img', $message->embed['description']);
        $this->assertStringContainsString("Texte de l'article.", $message->embed['description']);
    }

    public function testEmbedHasNoImageKeyWhenTheArticleHasNoImage(): void
    {
        $article = Article::factory()->create(['content' => "## Introduction\n\nTexte de l'article."]);

        $notification = new DraftReadyForReview($article);
        $message = $notification->toDiscord(new AnonymousNotifiable());

        $this->assertArrayNotHasKey('image', $message->embed);
    }
}
