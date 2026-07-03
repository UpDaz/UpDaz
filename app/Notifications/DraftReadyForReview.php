<?php

namespace App\Notifications;

use App\Filament\Resources\Articles\ArticleResource;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DraftReadyForReview extends Notification implements ShouldQueue
{
    use Queueable;

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
        $editUrl = ArticleResource::getUrl('edit', ['record' => $this->article]);

        return DiscordMessage::create(
            "📝 Nouveau brouillon généré par l'agent IA : **{$this->article->title}**\n{$editUrl}"
        );
    }
}
