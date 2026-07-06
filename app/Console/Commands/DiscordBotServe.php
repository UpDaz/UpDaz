<?php

namespace App\Console\Commands;

use App\Models\Article;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\TextInput;
use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Interactions\Interaction;
use Discord\WebSockets\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;

class DiscordBotServe extends Command
{
    protected $signature = 'discord:serve';

    protected $description = 'Run the persistent Discord bot listening for article review interactions.';

    /**
     * Guards against running more than one instance at once (e.g. if
     * `blog:weekly-pipeline` runs again before a previous draft has
     * been reviewed). The TTL is just a safety net in case a previous
     * instance crashed without releasing the lock.
     */
    private const LOCK_KEY = 'discord-bot-serve-running';

    public function handle(): void
    {
        if (! Cache::add(self::LOCK_KEY, true, now()->addDay())) {
            notice('[DiscordBotServe] Une instance tourne déjà, arrêt immédiat.');

            return;
        }

        register_shutdown_function(fn () => Cache::forget(self::LOCK_KEY));

        $discord = new Discord([
            'token' => config('services.discord.token'),
        ]);

        // Ctrl+C / `kill` (SIGINT/SIGTERM) otherwise terminate the process
        // without running the shutdown function above, leaving the lock
        // stuck (up to its 1-day TTL) and blocking the next `discord:serve`.
        foreach ([SIGINT, SIGTERM] as $signal) {
            $discord->getLoop()->addSignal($signal, function () use ($discord, $signal) {
                notice('[DiscordBotServe] Signal reçu, arrêt du bot.', ['signal' => $signal]);
                $discord->close();
            });
        }

        $discord->on('init', function (Discord $discord) {
            notice('[DiscordBotServe] Bot connecté', ['username' => $discord->user->username]);
            $this->info('Discord bot connecté en tant que ' . $discord->user->username);
        });

        $discord->on(Event::INTERACTION_CREATE, function (Interaction $interaction) use ($discord) {
            if ($interaction->type !== Interaction::TYPE_MESSAGE_COMPONENT) {
                return;
            }

            [$prefix, $action, $articleId] = array_pad(
                explode(':', (string) $interaction->data->custom_id, 3),
                3,
                null
            );

            if ($prefix !== 'article' || $articleId === null) {
                return;
            }

            notice('[DiscordBotServe] Interaction reçue', [
                'action' => $action,
                'article_id' => $articleId,
                'user' => $interaction->user->username,
            ]);

            $article = Article::find($articleId);

            if (! $article) {
                warning('[DiscordBotServe] Article introuvable pour l\'interaction', ['article_id' => $articleId]);

                $interaction->respondWithMessage(
                    MessageBuilder::new()->setContent('⚠️ Article introuvable.'),
                    true
                );

                return;
            }

            match ($action) {
                'approve' => $this->approve($interaction, $article, $discord),
                'revise' => $this->requestRevision($interaction, $article),
                default => null,
            };
        });

        $discord->run();
    }

    private function approve(Interaction $interaction, Article $article, Discord $discord): void
    {
        $article->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        notice('[DiscordBotServe] Article approuvé et publié', [
            'article_id' => $article->id,
            'user' => $interaction->user->username,
        ]);

        $interaction->updateMessage(
            MessageBuilder::new()->setContent(
                "✅ Article **{$article->title}** publié par {$interaction->user->username}."
            )
        )->then(function () use ($discord) {
            // Attend la réponse à Discord avant de couper la boucle
            // d'événements, sinon la requête risque de ne jamais partir.
            notice('[DiscordBotServe] Arrêt du bot après publication');

            $discord->close();
        });
    }

    private function requestRevision(Interaction $interaction, Article $article): void
    {
        // Uses the classic ActionRow-wrapped TextInput (supported by
        // modals for years) rather than the newer Label component:
        // Label submissions hit a real bug in discord-php v10.51.0 (see
        // `extractFeedback()`'s docblock) and, even with that bug
        // routed around, Label-based modals are new enough that we'd
        // rather not stake feedback capture on them.
        $feedbackInput = TextInput::new('Modifications souhaitées', TextInput::STYLE_PARAGRAPH, 'feedback')
            ->setRequired(true)
            ->setPlaceholder('Décris les modifications à apporter...');

        $interaction->showModal(
            'Demander des modifications',
            'article_revise_modal:' . $article->id,
            [ActionRow::new()->addComponent($feedbackInput)],
            function (Interaction $modalInteraction) use ($article) {
                $feedback = $this->extractFeedback($modalInteraction) ?? '';

                notice('[DiscordBotServe] Révision demandée', [
                    'article_id' => $article->id,
                    'feedback' => $feedback,
                ]);

                $modalInteraction->respondWithMessage(
                    MessageBuilder::new()->setContent('🔄 Révision en cours de génération...'),
                    true
                );

                $this->runRevisionInBackground($article, $feedback);
            }
        );
    }

    /**
     * Runs the revision in its own process rather than dispatching
     * `ReviseSeoArticleJob` directly: with `QUEUE_CONNECTION=sync`,
     * dispatching would call the (slow) AI provider synchronously
     * from inside this bot's ReactPHP event loop, freezing it — which
     * is what made Discord show "Une erreur s'est produite" on the
     * modal (our own acknowledgement never got a chance to be sent
     * before Discord's response timeout) and, if the AI call failed,
     * silently dropped the requested changes.
     *
     * The command is spawned with an array command (not a shell
     * string), so the freeform feedback text is passed as a single
     * argument safely, whatever punctuation or newlines it contains.
     */
    private function runRevisionInBackground(Article $article, string $feedback): void
    {
        Process::path(base_path())->start([
            PHP_BINARY,
            'artisan',
            'articles:revise',
            (string) $article->id,
            $feedback,
        ]);
    }

    /**
     * Walks the modal's raw submitted components ourselves rather than
     * relying on the flattened collection `Interaction::createListener()`
     * passes as a 2nd argument to the submit callback (that flattening
     * has a real bug for Label-wrapped components in discord-php
     * v10.51.0 — see the git history of this method).
     *
     * `data->components` is a discord-php Collection keyed by each
     * component's `id` (not a plain 0-indexed list) — confirmed by
     * logging its raw shape:
     *
     *   {"1": {"type":1, "components": {"2": {"type":4, "custom_id":"feedback", "value":"test", ...}}}}
     *
     * Rather than lean on that Collection's own iteration/attribute
     * behavior (magic getters, `empty()` being always false on a non-
     * null object, etc.), we round-trip it through JSON so we're only
     * ever dealing with plain stdClass/array data of a known shape.
     */
    private function extractFeedback(Interaction $modalInteraction): ?string
    {
        $components = json_decode(json_encode($modalInteraction->data->components ?? []));

        return $this->findFeedbackValue((array) $components);
    }

    private function findFeedbackValue(iterable $containers): ?string
    {
        foreach ($containers as $container) {
            if (($container->custom_id ?? null) === 'feedback' && isset($container->value)) {
                return $container->value;
            }

            if (isset($container->components) && ($value = $this->findFeedbackValue((array) $container->components))) {
                return $value;
            }

            if (isset($container->component) && ($value = $this->findFeedbackValue([$container->component]))) {
                return $value;
            }
        }

        return null;
    }
}
