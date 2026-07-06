<?php

namespace App\Services;

use Illuminate\Support\Arr;
use MarvinLabs\DiscordLogger\Contracts\DiscordWebHook;
use MarvinLabs\DiscordLogger\Converters\RichRecordConverter;
use MarvinLabs\DiscordLogger\Discord\Embed;
use MarvinLabs\DiscordLogger\Discord\Exceptions\ConfigurationIssue;
use MarvinLabs\DiscordLogger\Discord\Message;

class DiscordLog extends RichRecordConverter
{
    /**
     * @throws ConfigurationIssue
     */
    public function buildMessages(array $record): array
    {
        $mainMessage = Message::make();

        $this->addGenericMessageFrom($mainMessage);
        $this->addMainEmbed($mainMessage, $record);
        $fileMessage = null;
        $stacktrace = $this->getStacktrace($record);

        if ($stacktrace !== null) {
            switch ($this->stackTraceMode($stacktrace)) {
                case 'file':
                    // Discord webhooks do not support EMBED + FILE at the same time.
                    // Hence another message has to be sent
                    $fileMessage = Message::make()->file($stacktrace, $this->getStacktraceFilename($record));
                    $this->addGenericMessageFrom($fileMessage);
                    break;

                case 'inline':
                    $this->addInlineMessageStacktrace($mainMessage, $record, $stacktrace);
                    break;

                default:
                    throw new ConfigurationIssue('Invalid value for configuration `discord-logger.stacktrace`');
            }
        } elseif (strlen($record['message']) > DiscordWebHook::MAX_CONTENT_LENGTH) {
            $fileMessage = Message::make()->file($record['message'], $this->getStacktraceFilename($record));
            $this->addGenericMessageFrom($fileMessage);
        }

        return $fileMessage !== null ? [$mainMessage, $fileMessage] : [$mainMessage];
    }

    protected function addMainEmbed(Message $message, array $record): void
    {
        $title = "{$record['level_name']}";
        $description = "\n\n**Message**\n" . $record['message'];
        $emoji = $this->getRecordEmoji($record);

        $context = Arr::except($record['context'] ?? [], ['exception']);
        if (! empty($context)) {
            $description .= "\n\n**Context**\n" . json_encode($context, JSON_PRETTY_PRINT);
        }

        $message->embed(Embed::make()
            ->color($this->getRecordColor($record))
            ->title($emoji === null ? "`$title`" : "$emoji  $title")
            ->description($description));
    }
}
