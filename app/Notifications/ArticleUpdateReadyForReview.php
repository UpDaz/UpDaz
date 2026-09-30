<?php

namespace App\Notifications;

use App\Models\WeeklyDigest;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\Button;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

/**
 * An update of a published article, validated from the list of changes
 * rather than a full reread: the article stays online meanwhile.
 */
class ArticleUpdateReadyForReview extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Discord's hard cap on embed description length.
     */
    private const DESCRIPTION_MAX_LENGTH = 4096;

    public function __construct(
        public readonly WeeklyDigest $digest,
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
        $article = $this->digest->overlappingArticle;

        $actions = ActionRow::new()
            ->addComponent(
                Button::success("topic:apply-update:{$this->digest->id}")->setLabel('✅ Appliquer la mise à jour')
            )
            ->addComponent(
                Button::danger("topic:reject-update:{$this->digest->id}")->setLabel('❌ Refuser')
            );

        return DiscordMessage::create(
            "🔄 Mise à jour proposée pour **{$article->title}**, à partir de l'actualité « {$this->digest->displayTitle()} »."
        )
            ->embed([
                'title' => Str::limit($article->title, 256, ''),
                'url' => $article->frontendUrl(),
                'color' => 0xF0B232,
                'description' => Str::limit((string) $this->digest->proposed_update_summary, self::DESCRIPTION_MAX_LENGTH - 1, '…'),
            ])
            ->components([$actions->jsonSerialize()]);
    }
}
