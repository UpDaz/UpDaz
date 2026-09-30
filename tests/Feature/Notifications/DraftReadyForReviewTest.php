<?php

namespace Tests\Feature\Notifications;

use App\Models\Article;
use App\Models\WeeklyDigest;
use App\Notifications\DraftReadyForReview;
use Discord\Builders\Components\Button;
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

        $this->assertCount(3, $buttons);
        $this->assertSame('article:approve-experience:' . $article->id, $buttons[0]['custom_id']);
        $this->assertSame('article:approve-watch:' . $article->id, $buttons[1]['custom_id']);
        $this->assertSame('article:revise:' . $article->id, $buttons[2]['custom_id']);
    }

    public function testSuggestsWatchWhenTheInterviewBroughtNoExperience(): void
    {
        $article = Article::factory()->create();
        WeeklyDigest::factory()->create(['post_id' => $article->id, 'interview_answers' => ['', '']]);

        $buttons = $this->buttons(new DraftReadyForReview($article));

        $this->assertSame(Button::STYLE_SECONDARY, $buttons[0]['style']);
        $this->assertSame(Button::STYLE_SUCCESS, $buttons[1]['style']);
    }

    public function testSuggestsFieldExperienceWhenTheInterviewWasAnswered(): void
    {
        $article = Article::factory()->create();
        WeeklyDigest::factory()->create([
            'post_id' => $article->id,
            'interview_questions' => ['Quel projet ?'],
            'interview_answers' => ['Une reprise Laravel 8.'],
        ]);

        $buttons = $this->buttons(new DraftReadyForReview($article));

        $this->assertSame(Button::STYLE_SUCCESS, $buttons[0]['style']);
        $this->assertSame(Button::STYLE_SECONDARY, $buttons[1]['style']);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function buttons(DraftReadyForReview $notification): array
    {
        $message = $notification->toDiscord(new AnonymousNotifiable());

        return json_decode(json_encode($message->components), true)[0]['components'];
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
