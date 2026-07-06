<?php

namespace App\Notifications;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\Button;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DraftReadyForReview extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Discord's hard cap on embed description length.
     */
    private const DESCRIPTION_MAX_LENGTH = 4096;

    public function __construct(
        public readonly Article $article,
    ) {
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [DiscordChannel::class];
    }

    public function toDiscord(object $notifiable): DiscordMessage
    {
        $previewUrl = $this->article->frontendUrl();
        $editUrl = ArticleResource::getUrl('edit', ['record' => $this->article]);

        $actions = ActionRow::new()
            ->addComponent(
                Button::success('article:approve:' . $this->article->id)
                    ->setLabel('✅ Valider')
            )
            ->addComponent(
                Button::primary('article:revise:' . $this->article->id)
                    ->setLabel('✏️ Demander des modifications')
            );

        return DiscordMessage::create(
            "📝 Nouveau brouillon généré par l'agent IA : **{$this->article->title}**"
        )
            ->embed($this->buildEmbed($previewUrl, $editUrl))
            ->components([$actions->jsonSerialize()]);
    }

    /**
     * @return array<string, mixed>
     */
    private function buildEmbed(string $previewUrl, string $editUrl): array
    {
        $rawContent = (string) $this->article->getRawOriginal('content');

        // Discord doesn't render arbitrary HTML: the source images injected
        // before each H2 (see WeeklyDigest::injectSourceImages()) would show
        // up as literal `<img ...>` text in the description. We show one of
        // them as the embed's own image instead and strip the rest from the
        // text.
        $imageUrl = $this->firstImageUrl($rawContent);
        $textContent = $this->stripImageTags($rawContent);

        $truncationNotice = "\n\n*(contenu tronqué — [voir la version complète]({$previewUrl}))*";

        $content = Str::limit(
            $textContent,
            self::DESCRIPTION_MAX_LENGTH - strlen($truncationNotice),
            $truncationNotice
        );

        return array_filter([
            'title' => Str::limit($this->article->title, 256, ''),
            'url' => $previewUrl,
            'color' => 0x5865F2,
            'description' => $content,
            'image' => $imageUrl ? ['url' => $imageUrl] : null,
            'fields' => [
                [
                    'name' => 'Meta description',
                    'value' => Str::limit((string) $this->article->meta_description, 1024, '') ?: '—',
                ],
                [
                    'name' => 'Tags',
                    'value' => collect($this->article->tags)->implode(', ') ?: '—',
                ],
                [
                    'name' => 'Édition (admin)',
                    'value' => $editUrl,
                ],
            ],
        ], fn ($value) => $value !== null);
    }

    private function firstImageUrl(string $rawContent): ?string
    {
        preg_match('/<img src="([^"]*)"/', $rawContent, $matches);

        return $matches[1] ?? null;
    }

    private function stripImageTags(string $rawContent): string
    {
        return trim(preg_replace('/<img[^>]*>\n*/i', '', $rawContent));
    }
}
