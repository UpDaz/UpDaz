<?php

namespace App\Console\Commands;

use App\Enums\TopicStatus;
use App\Models\WeeklyDigest;
use App\Notifications\InterviewReady;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Throwable;

class ExpireTopics extends Command
{
    protected $signature = 'blog:expire-topics';

    protected $description = 'Reminds unanswered interviews once, then expires topics left without a decision.';

    public function handle(): int
    {
        $expiredCount = WeeklyDigest::query()
            ->where(function ($query): void {
                $query->where('status', TopicStatus::Proposed)
                    ->where('proposed_at', '<=', now()->subDays(WeeklyDigest::EXPIRES_AFTER_DAYS));
            })
            ->orWhere(function ($query): void {
                $query->where('status', TopicStatus::Interviewing)
                    ->where('interview_sent_at', '<=', now()->subDays(WeeklyDigest::EXPIRES_AFTER_DAYS));
            })
            ->update(['status' => TopicStatus::Expired]);

        $this->comment("{$expiredCount} sujet(s) expiré(s).");

        $interviewsToRemind = WeeklyDigest::query()
            ->where('status', TopicStatus::Interviewing)
            ->whereNull('reminded_at')
            ->where('interview_sent_at', '<=', now()->subDays(WeeklyDigest::REMIND_AFTER_DAYS))
            ->get();

        $interviewsToRemind->each(function (WeeklyDigest $digest): void {
            $this->info("Rappel pour le sujet #{$digest->id}...");

            try {
                Notification::route('discord', config('blog.discord_channel_id'))
                    ->notify(new InterviewReady($digest, isReminder: true));
            } catch (Throwable $e) {
                warning('[ExpireTopics] Échec d\'envoi du rappel', ['digest_id' => $digest->id, 'error' => $e->getMessage()]);

                return;
            }

            $digest->update(['reminded_at' => now()]);
        });

        $this->comment("{$interviewsToRemind->count()} rappel(s) envoyé(s).");

        return self::SUCCESS;
    }
}
