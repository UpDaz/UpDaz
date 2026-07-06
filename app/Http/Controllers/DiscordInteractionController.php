<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Discord\Parts\Interactions\Interaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

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
            'revise' => $this->showReviseModal($article),
            default => response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]),
        };
    }

    private function approve(Article $article, array $payload): JsonResponse
    {
        $article->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        $username = $this->username($payload);

        notice('[DiscordInteractionController] Article approuvé et publié', [
            'article_id' => $article->id,
            'user' => $username,
        ]);

        return response()->json([
            'type' => Interaction::RESPONSE_TYPE_UPDATE_MESSAGE,
            'data' => [
                'content' => "✅ Article **{$article->title}** publié par {$username}.",
                'embeds' => [],
                'components' => [],
            ],
        ]);
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

        if ($prefix !== 'article_revise_modal' || $articleId === null) {
            return response()->json(['type' => Interaction::RESPONSE_TYPE_PONG]);
        }

        $article = Article::find($articleId);

        if (! $article) {
            warning('[DiscordInteractionController] Article introuvable pour la révision', ['article_id' => $articleId]);

            return $this->ephemeralMessage('⚠️ Article introuvable.');
        }

        $feedback = $this->extractFeedback($payload['data']['components'] ?? []) ?? '';

        notice('[DiscordInteractionController] Révision demandée', [
            'article_id' => $article->id,
            'feedback' => $feedback,
        ]);

        // Runs in its own process rather than dispatching the job
        // directly: with QUEUE_CONNECTION=sync, the (slow) AI call
        // would block this HTTP request well past Discord's 3-second
        // response window.
        Process::path(base_path())->start([
            PHP_BINARY,
            'artisan',
            'articles:revise',
            (string) $article->id,
            $feedback,
        ]);

        return $this->ephemeralMessage('🔄 Révision en cours de génération...');
    }

    /**
     * Discord nests the submitted Text Input under an Action Row's
     * `components` (classic layout) or, with the newer Label
     * component, directly under a `component` key — recurse through
     * both shapes and match on the field's custom_id.
     *
     * @param  array<int, array<string, mixed>>  $containers
     */
    private function extractFeedback(array $containers): ?string
    {
        foreach ($containers as $container) {
            if (($container['custom_id'] ?? null) === 'feedback' && isset($container['value'])) {
                return $container['value'];
            }

            if (! empty($container['components']) && ($value = $this->extractFeedback($container['components']))) {
                return $value;
            }

            if (! empty($container['component']) && ($value = $this->extractFeedback([$container['component']]))) {
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
