<?php

namespace Tests\Feature\Console;

use App\Enums\TopicStatus;
use App\Models\WeeklyDigest;
use App\Notifications\InterviewReady;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ExpireTopicsTest extends TestCase
{
    use RefreshDatabase;

    public function testExpiresTopicsLeftWithoutDecision(): void
    {
        Notification::fake();

        $staleTopic = WeeklyDigest::factory()->create(['status' => TopicStatus::Proposed, 'proposed_at' => now()->subDays(8)]);
        $freshTopic = WeeklyDigest::factory()->create(['status' => TopicStatus::Proposed, 'proposed_at' => now()->subDays(2)]);
        $staleInterview = WeeklyDigest::factory()->create(['status' => TopicStatus::Interviewing, 'interview_sent_at' => now()->subDays(8)]);

        $this->artisan('blog:expire-topics')->assertExitCode(0);

        $this->assertSame(TopicStatus::Expired, $staleTopic->fresh()->status);
        $this->assertSame(TopicStatus::Proposed, $freshTopic->fresh()->status);
        $this->assertSame(TopicStatus::Expired, $staleInterview->fresh()->status);
    }

    public function testRemindsAnUnansweredInterviewOnlyOnce(): void
    {
        Notification::fake();

        $digest = WeeklyDigest::factory()->create(['status' => TopicStatus::Interviewing, 'interview_sent_at' => now()->subDays(4)]);

        $this->artisan('blog:expire-topics')->assertExitCode(0);
        $this->artisan('blog:expire-topics')->assertExitCode(0);

        Notification::assertSentOnDemandTimes(InterviewReady::class, 1);
        Notification::assertSentOnDemand(InterviewReady::class, fn (InterviewReady $notification): bool => $notification->isReminder);
        $this->assertNotNull($digest->fresh()->reminded_at);
    }
}
