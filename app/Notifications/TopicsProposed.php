<?php

namespace App\Notifications;

use App\Models\WeeklyDigest;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\Button;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

/**
 * The weekly topics, one row of buttons each: start the interview for a
 * new article, or update the published article that already covers it.
 */
class TopicsProposed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Discord's hard cap on button label length.
     */
    private const LABEL_MAX_LENGTH = 80;

    /**
     * @param  Collection<int, WeeklyDigest>  $digests
     */
    public function __construct(
        public readonly Collection $digests,
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
        $lines = $this->digests
            ->values()
            ->map(function (WeeklyDigest $digest, int $index): string {
                $number = $index + 1;
                $overlap = $digest->overlappingArticle
                    ? "\n   ↳ Déjà traité par « {$digest->overlappingArticle->title} » : mise à jour proposée."
                    : '';

                return "**{$number}. {$digest->displayTitle()}**{$overlap}";
            })
            ->implode("\n\n");

        $expiresInDays = WeeklyDigest::EXPIRES_AFTER_DAYS;

        return DiscordMessage::create(
            "🗞️ Sujets de la semaine : choisis ceux sur lesquels tu as quelque chose à dire. Les autres expirent dans {$expiresInDays} jours.\n\n{$lines}"
        )->components(
            $this->digests
                ->values()
                ->map(fn (WeeklyDigest $digest, int $index): array => $this->actions($digest, $index + 1)->jsonSerialize())
                ->all()
        );
    }

    private function actions(WeeklyDigest $digest, int $number): ActionRow
    {
        $actions = ActionRow::new()->addComponent(
            Button::primary("topic:choose:{$digest->id}")
                ->setLabel($this->label("🎤 {$number}. Nouvel article (interview)"))
        );

        if (! $digest->overlappingArticle) {
            return $actions;
        }

        return $actions->addComponent(
            Button::secondary("topic:update:{$digest->id}")
                ->setLabel($this->label("🔄 {$number}. Mettre à jour « {$digest->overlappingArticle->title} »"))
        );
    }

    private function label(string $label): string
    {
        return Str::limit($label, self::LABEL_MAX_LENGTH - 1, '…');
    }
}
