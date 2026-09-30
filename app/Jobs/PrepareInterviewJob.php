<?php

namespace App\Jobs;

use App\AI\Agents\InterviewerAgent;
use App\Enums\TopicStatus;
use App\Models\WeeklyDigest;
use App\Notifications\InterviewReady;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Throwable;

/**
 * Asks the editor about his own experience of a chosen topic, so the
 * article carries what no other blog can write.
 */
class PrepareInterviewJob implements ShouldQueue
{
    use Queueable;

    /**
     * Discord's hard cap on a modal text input placeholder, where each
     * question is repeated next to its answer field.
     */
    private const QUESTION_MAX_LENGTH = 100;

    public function __construct(
        public readonly WeeklyDigest $digest,
    ) {
    }

    public function handle(): void
    {
        notice('[PrepareInterviewJob] Démarrage', ['digest_id' => $this->digest->id]);

        $schema = new ObjectSchema('interview', 'Questions d\'interview', [
            new ArraySchema(
                'questions',
                'Exactement ' . InterviewerAgent::QUESTIONS_COUNT . ' questions de moins de 100 caractères',
                new StringSchema('question', ''),
            ),
        ], ['questions']);

        try {
            $interview = (new InterviewerAgent())
                ->withSchema($schema)
                ->prompt(<<<BRIEF
                <sujet>
                {$this->digest->displayTitle()}
                </sujet>

                <synthese>
                {$this->digest->summary}
                </synthese>
                BRIEF);
        } catch (Throwable $e) {
            warning('[PrepareInterviewJob] Échec de préparation de l\'interview', [
                'digest_id' => $this->digest->id,
                'error' => $e->getMessage(),
            ]);

            $this->digest->update(['status' => TopicStatus::Proposed]);

            return;
        }

        $questions = collect($interview->questions ?? [])
            ->map(fn (string $question): string => Str::limit(trim($question), self::QUESTION_MAX_LENGTH - 1, '…'))
            ->filter()
            ->take(InterviewerAgent::QUESTIONS_COUNT)
            ->values()
            ->all();

        $this->digest->update([
            'status' => TopicStatus::Interviewing,
            'interview_questions' => $questions,
            'interview_sent_at' => now(),
        ]);

        Notification::route('discord', config('blog.discord_channel_id'))
            ->notify(new InterviewReady($this->digest));

        notice('[PrepareInterviewJob] Interview envoyée', ['digest_id' => $this->digest->id]);
    }
}
