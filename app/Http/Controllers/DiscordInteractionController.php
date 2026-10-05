<?php

namespace App\Http\Controllers;

use App\Console\Commands\RunTopicStep;
use App\Enums\TopicStatus;
use App\Models\Article;
use App\Models\Category;
use App\Models\WeeklyDigest;
use Discord\Parts\Interactions\Interaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

use function Illuminate\Support\php_binary;

/**
 * Handles Discord interactions (button clicks, modal submissions) via
 * the Interactions Endpoint URL: Discord POSTs each interaction here
 * instead of requiring a persistent bot connected to its Gateway,
 * which isn't viable on shared hosting without a long-running process.
 *
 * @link https://discord.com/developers/docs/interactions/receiving-and-responding
 */
class DiscordInteractionController extends Controller
{
    private const FLAG_EPHEMERAL = 64;

    public function handle(Request $request): JsonResponse
    {
        $payload = $request->json()->all();

        return match ($payload['type'] ?? null) {
            Interaction::TYPE_PING => response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]),
            Interaction::TYPE_MESSAGE_COMPONENT => $this->handleComponent($payload),
            Interaction::TYPE_MODAL_SUBMIT => $this->handleModalSubmit($payload),
            default => response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]),
        };
    }

    private function handleComponent(array $payload): JsonResponse
    {
        [$prefix, $action, $articleId] = array_pad(
            explode(':', $payload['data']['custom_id'] ?? '', 3),
            3,
            null
        );

        if ($prefix === 'topic' && $articleId !== null) {
            return $this->handleTopicComponent($action, $articleId, $payload);
        }

        if ($prefix !== 'article' || $articleId === null) {
            return response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]);
        }

        $article = Article::find($articleId);

        if (! $article) {
            warning('[DiscordInteractionController] Article introuvable pour l\'interaction', ['article_id' => $articleId]);

            return $this->ephemeralMessage('⚠️ Article introuvable.');
        }

        return match ($action) {
            'approve' => $this->approve($article, $payload),
            'approve-experience' => $this->approve($article, $payload, Category::FIELD_EXPERIENCE_SLUG),
            'approve-watch' => $this->approve($article, $payload, Category::WATCH_SLUG),
            'revise' => $this->showReviseModal($article),
            default => response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]),
        };
    }

    private function approve(Article $article, array $payload, ?string $labelSlug = null): JsonResponse
    {
        $label = $labelSlug ? Category::query()->where('slug', $labelSlug)->first() : null;

        if ($label) {
            $otherLabelIds = Category::query()
                ->whereIn('slug', Category::LABEL_SLUGS)
                ->whereKeyNot($label->id)
                ->pluck('id');

            $article->categories()->detach($otherLabelIds);
            $article->categories()->syncWithoutDetaching([$label->id]);
        }

        $article->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        $username = $this->username($payload);

        notice('[DiscordInteractionController] Article approuvé et publié', [
            'article_id' => $article->id,
            'label' => $label?->slug,
            'user' => $username,
        ]);

        $labelSuffix = $label ? " en « {$label->name} »" : '';

        return $this->updateMessage("✅ Article **{$article->title}** publié{$labelSuffix} par {$username}.");
    }

    private function handleTopicComponent(string $action, string $digestId, array $payload): JsonResponse
    {
        $digest = WeeklyDigest::find($digestId);

        if (! $digest) {
            warning('[DiscordInteractionController] Sujet introuvable pour l\'interaction', ['digest_id' => $digestId]);

            return $this->ephemeralMessage('⚠️ Sujet introuvable.');
        }

        return match ($action) {
            'choose' => $this->chooseTopic($digest),
            'update' => $this->updateFromTopic($digest),
            'answer' => $this->showInterviewModal($digest),
            'skip' => $this->skipInterview($digest),
            'apply-update' => $this->applyUpdate($digest, $payload),
            'reject-update' => $this->rejectUpdate($digest, $payload),
            default => response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]),
        };
    }

    private function chooseTopic(WeeklyDigest $digest): JsonResponse
    {
        if ($digest->status !== TopicStatus::Proposed) {
            return $this->ephemeralMessage('⚠️ Ce sujet a déjà été choisi ou a expiré.');
        }

        $digest->update(['status' => TopicStatus::Interviewing]);

        $this->startTopicStep(RunTopicStep::PREPARE_INTERVIEW, $digest);

        return $this->ephemeralMessage("🎤 Préparation des questions sur « {$digest->displayTitle()} »...");
    }

    private function updateFromTopic(WeeklyDigest $digest): JsonResponse
    {
        if ($digest->status !== TopicStatus::Proposed || ! $digest->overlapping_article_id) {
            return $this->ephemeralMessage('⚠️ Ce sujet a déjà été choisi ou a expiré.');
        }

        $digest->update(['status' => TopicStatus::Drafting]);

        $this->startTopicStep(RunTopicStep::PROPOSE_UPDATE, $digest);

        return $this->ephemeralMessage('🔄 Préparation de la mise à jour...');
    }

    /**
     * One paragraph field per question: the label is capped at 45
     * characters by Discord, so the question itself goes in the
     * placeholder (capped at 100, see PrepareInterviewJob).
     */
    private function showInterviewModal(WeeklyDigest $digest): JsonResponse
    {
        if ($digest->status !== TopicStatus::Interviewing) {
            return $this->ephemeralMessage('⚠️ Cette interview est terminée ou a expiré.');
        }

        $fields = collect($digest->interview_questions ?? [])
            ->map(fn (string $question, int $index): array => [
                'type' => 1, // Action Row
                'components' => [
                    [
                        'type' => 4, // Text Input
                        'custom_id' => "answer_{$index}",
                        'style' => 2, // Paragraph
                        'label' => 'Question ' . ($index + 1),
                        'placeholder' => $question,
                        'required' => false,
                    ],
                ],
            ])
            ->all();

        return response()->json([
            'type' => Interaction::RESPONSE_TYPE_MODAL,
            'data' => [
                'title' => 'Interview',
                'custom_id' => 'topic_answers_modal:' . $digest->id,
                'components' => $fields,
            ],
        ]);
    }

    private function skipInterview(WeeklyDigest $digest): JsonResponse
    {
        if ($digest->status !== TopicStatus::Interviewing) {
            return $this->ephemeralMessage('⚠️ Cette interview est terminée ou a expiré.');
        }

        $digest->update(['status' => TopicStatus::Drafting]);

        $this->startTopicStep(RunTopicStep::DRAFT, $digest);

        return $this->updateMessage("🤷 Rédaction d'un article de veille sur « {$digest->displayTitle()} »...");
    }

    private function applyUpdate(WeeklyDigest $digest, array $payload): JsonResponse
    {
        if ($digest->proposed_update === null) {
            return $this->ephemeralMessage('⚠️ Cette mise à jour a déjà été traitée.');
        }

        $digest->applyProposedUpdate();

        $username = $this->username($payload);

        notice('[DiscordInteractionController] Mise à jour appliquée', [
            'digest_id' => $digest->id,
            'article_id' => $digest->overlapping_article_id,
            'user' => $username,
        ]);

        return $this->updateMessage("✅ Mise à jour de **{$digest->overlappingArticle->title}** appliquée par {$username}.");
    }

    private function rejectUpdate(WeeklyDigest $digest, array $payload): JsonResponse
    {
        $digest->update([
            'status' => TopicStatus::Expired,
            'proposed_update' => null,
        ]);

        return $this->updateMessage("❌ Mise à jour refusée par {$this->username($payload)}.");
    }

    private function startTopicStep(string $step, WeeklyDigest $digest): void
    {
        $this->runArtisanInBackground(['blog:topic', $step, (string) $digest->id]);
    }

    /**
     * The AI call must not block this HTTP request past Discord's
     * 3-second response window (and QUEUE_CONNECTION=sync rules out a
     * plain dispatch), so the command is detached through the shell: a
     * process that is merely started gets killed by Symfony's Process
     * destructor as soon as the request ends. PHP_BINARY can't be used
     * either, as it points to php-fpm rather than the CLI under FPM.
     *
     * @param  array<int, string>  $arguments
     */
    private function runArtisanInBackground(array $arguments): void
    {
        $command = collect([php_binary(), 'artisan', ...$arguments])
            ->map(fn (string $argument): string => escapeshellarg($argument))
            ->implode(' ');

        $log = escapeshellarg(storage_path('logs/discord-background.log'));

        Process::path(base_path())->run("nohup {$command} >> {$log} 2>&1 &");
    }

    private function showReviseModal(Article $article): JsonResponse
    {
        return response()->json([
            'type' => Interaction::RESPONSE_TYPE_MODAL,
            'data' => [
                'title' => 'Demander des modifications',
                'custom_id' => 'article_revise_modal:' . $article->id,
                'components' => [
                    [
                        'type' => 1, // Action Row
                        'components' => [
                            [
                                'type' => 4, // Text Input
                                'custom_id' => 'feedback',
                                'style' => 2, // Paragraph
                                'label' => 'Modifications souhaitées',
                                'placeholder' => 'Décris les modifications à apporter...',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function handleModalSubmit(array $payload): JsonResponse
    {
        [$prefix, $articleId] = array_pad(
            explode(':', $payload['data']['custom_id'] ?? '', 2),
            2,
            null
        );

        if ($prefix === 'topic_answers_modal' && $articleId !== null) {
            return $this->handleInterviewAnswers($articleId, $payload['data']['components'] ?? []);
        }

        if ($prefix !== 'article_revise_modal' || $articleId === null) {
            return response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]);
        }

        $article = Article::find($articleId);

        if (! $article) {
            warning('[DiscordInteractionController] Article introuvable pour la révision', ['article_id' => $articleId]);

            return $this->ephemeralMessage('⚠️ Article introuvable.');
        }

        $feedback = $this->extractTextInput($payload['data']['components'] ?? [], 'feedback') ?? '';

        notice('[DiscordInteractionController] Révision demandée', [
            'article_id' => $article->id,
            'feedback' => $feedback,
        ]);

        $this->runArtisanInBackground(['articles:revise', (string) $article->id, $feedback]);

        return $this->ephemeralMessage('🔄 Révision en cours de génération...');
    }

    /**
     * @param  array<int, array<string, mixed>>  $components
     */
    private function handleInterviewAnswers(string $digestId, array $components): JsonResponse
    {
        $digest = WeeklyDigest::find($digestId);

        if (! $digest || $digest->status !== TopicStatus::Interviewing) {
            return $this->ephemeralMessage('⚠️ Cette interview est terminée ou a expiré.');
        }

        $answers = collect($digest->interview_questions ?? [])
            ->keys()
            ->map(fn (int $index): string => trim((string) $this->extractTextInput($components, "answer_{$index}")))
            ->all();

        $digest->update([
            'interview_answers' => $answers,
            'status' => TopicStatus::Drafting,
        ]);

        notice('[DiscordInteractionController] Réponses d\'interview reçues', [
            'digest_id' => $digest->id,
            'avec_experience' => $digest->hasFieldExperience(),
        ]);

        $this->startTopicStep(RunTopicStep::DRAFT, $digest);

        return $this->updateMessage($digest->hasFieldExperience()
            ? "✍️ Réponses reçues, rédaction de « {$digest->displayTitle()} » en cours..."
            : "🤷 Aucune réponse : rédaction d'un article de veille sur « {$digest->displayTitle()} »...");
    }

    /**
     * Discord nests the submitted Text Input under an Action Row's
     * `components` (classic layout) or, with the newer Label
     * component, directly under a `component` key — recurse through
     * both shapes and match on the field's custom_id.
     *
     * @param  array<int, array<string, mixed>>  $containers
     */
    private function extractTextInput(array $containers, string $customId): ?string
    {
        foreach ($containers as $container) {
            if (($container['custom_id'] ?? null) === $customId && isset($container['value'])) {
                return $container['value'];
            }

            if (! empty($container['components']) && ($value = $this->extractTextInput($container['components'], $customId))) {
                return $value;
            }

            if (! empty($container['component']) && ($value = $this->extractTextInput([$container['component']], $customId))) {
                return $value;
            }
        }

        return null;
    }

    private function username(array $payload): string
    {
        return $payload['member']['user']['username']
            ?? $payload['user']['username']
            ?? 'quelqu\'un';
    }

    private function updateMessage(string $content): JsonResponse
    {
        return response()->json([
            'type' => Interaction::RESPONSE_TYPE_UPDATE_MESSAGE,
            'data' => [
                'content' => $content,
                'embeds' => [],
                'components' => [],
            ],
        ]);
    }

    private function ephemeralMessage(string $content): JsonResponse
    {
        return response()->json([
            'type' => Interaction::RESPONSE_TYPE_CHANNEL_MESSAGE_WITH_SOURCE,
            'data' => [
                'content' => $content,
                'flags' => self::FLAG_EPHEMERAL,
            ],
        ]);
    }
}
