<?php

namespace App\Logging;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use MarvinLabs\DiscordLogger\Contracts\DiscordWebHook;
use MarvinLabs\DiscordLogger\Contracts\RecordToMessage;
use MarvinLabs\DiscordLogger\Converters\SimpleRecordConverter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger as Monolog;
use Monolog\LogRecord;
use RuntimeException;

use function class_implements;

class CustomDiscordLogHandler extends AbstractProcessingHandler
{
    /** @var DiscordWebHook */
    private $discord;

    /** @var RecordToMessage */
    private $recordToMessage;

    /** @var bool */
    private $ignoreExceptions;

    /** @throws BindingResolutionException */
    public function __construct(Container $container, Repository $config, array $channelConfig)
    {
        parent::__construct(Monolog::toMonologLevel($channelConfig['level'] ?? Monolog::DEBUG));

        $this->discord = $container->make(DiscordWebHook::class, ['url' => $channelConfig['url']]);
        $this->recordToMessage = $this->createRecordConverter($container, $config);

        $this->ignoreExceptions = $channelConfig['ignore_exceptions'] ?? false;
    }

    public function write(array|LogRecord $record): void
    {
        if ($record instanceof LogRecord) {
            $record = $record->toArray();
        }

        if (config('app.env') === 'production') {
            unset($record['context']);
        }

        foreach ($this->recordToMessage->buildMessages($record) as $message) {
            try {
                $this->discord->send($message);
            } catch (\Exception $e) {
                if (! $this->ignoreExceptions) {
                    throw $e;
                }
            }
        }
    }

    /** @throws BindingResolutionException */
    protected function createRecordConverter(Container $container, Repository $config): RecordToMessage
    {
        $converter = $container->make(
            $config->get('discord-logger.converter', SimpleRecordConverter::class)
        );

        if (! class_implements($converter, RecordToMessage::class)) {
            throw new RuntimeException('The converter specified in the discord-logger configuration should implement the RecordToMessage interface');
        }

        return $converter;
    }
}
