<?php

namespace App\Logging;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use MarvinLabs\DiscordLogger\Contracts\DiscordWebHook;
use MarvinLabs\DiscordLogger\Discord\Exceptions\InvalidMessage;
use MarvinLabs\DiscordLogger\Discord\Exceptions\MessageCouldNotBeSent;
use MarvinLabs\DiscordLogger\Discord\Message;

class CustomGuzzleWebHook implements DiscordWebHook
{
    /** @var Client */
    protected $http;

    /** @var string */
    protected $url;

    public function __construct(HttpClient $http, string $url)
    {
        $this->http = $http;
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @throws InvalidMessage
     * @throws MessageCouldNotBeSent
     */
    public function send(Message $message): void
    {
        $payload = $this->buildPayload($message);
        $requestType = $this->requestType($message);

        try {
            $this->http->post($this->url, [$requestType => $payload]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $code = $response === null ? 0 : $response->getStatusCode();
            if ($code != 429) {
                throw MessageCouldNotBeSent::serviceRespondedWithAnError($e);
            }
        } catch (Exception $e) {
            throw MessageCouldNotBeSent::couldNotCommunicateWithDiscord($e);
        }
    }

    protected function requestType(Message $message): string
    {
        return $message->file !== null ? 'multipart' : 'json';
    }

    /**
     * @throws InvalidMessage
     */
    protected function buildPayload(Message $message): array
    {
        if ($this->isMessageEmpty($message)) {
            throw InvalidMessage::cannotSendAnEmptyMessage();
        }

        if ($this->requestType($message) === 'multipart') {
            return $this->buildMultipartPayload($message);
        }

        return $this->buildJsonPayload($message);
    }

    /**
     * @throws InvalidMessage
     */
    protected function buildJsonPayload(Message $message): array
    {
        if ($this->isMessageEmpty($message)) {
            throw InvalidMessage::cannotSendAnEmptyMessage();
        }

        return collect($message->toArray())->forget('file')->all();
    }

    /**
     * @throws InvalidMessage
     */
    protected function buildMultipartPayload(Message $message): array
    {
        if ($message->embeds !== null) {
            throw InvalidMessage::embedsNotSupportedWithFileUploads();
        }

        return collect($message->toArray())
            ->forget('file')
            ->reject(static function ($value) {
                return $value === null;
            })
            ->map(static function ($value, $key) {
                return ['name' => $key, 'contents' => $value];
            })
            ->push($message->file)
            ->values()
            ->all();
    }

    protected function isMessageEmpty($message): bool
    {
        return $message->content === null
               && $message->file === null
               && $message->embeds === null;
    }
}
