<?php

namespace App\Notifications;

use App\Models\WeeklyDigest;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\Button;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

/**
 * The interview questions for a chosen topic. Answers go through a
 * Discord modal: the bot only receives interactions, never messages.
 */
class InterviewReady extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly WeeklyDigest $digest,
        public readonly bool $isReminder = false,
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
        $questions = collect($this->digest->interview_questions ?? [])
            ->map(fn (string $question, int $index): string => ($index + 1) . ". {$question}")
            ->implode("\n");

        $intro = $this->isReminder
            ? "⏰ Rappel : l'interview sur **{$this->digest->displayTitle()}** attend tes réponses."
            : "🎤 Interview pour **{$this->digest->displayTitle()}**.";

        $expiresAt = $this->digest->interview_sent_at
            ?->copy()
            ->addDays(WeeklyDigest::EXPIRES_AFTER_DAYS)
            ->format('d/m');

        $actions = ActionRow::new()
            ->addComponent(
                Button::success("topic:answer:{$this->digest->id}")->setLabel('✍️ Répondre')
            )
            ->addComponent(
                Button::secondary("topic:skip:{$this->digest->id}")->setLabel('🤷 Pas d\'expérience : article de veille')
            );

        return DiscordMessage::create(
            "{$intro}\n\n{$questions}\n\nRéponds à celles qui te parlent, même en vrac. Sans réponse, le sujet expire le {$expiresAt}."
        )->components([$actions->jsonSerialize()]);
    }
}
