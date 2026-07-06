<?php

namespace App\AI;

use App\AI\Attributes\Model as ModelAttribute;
use App\AI\Attributes\Provider as ProviderAttribute;
use Prism\Prism\Contracts\Schema;
use Prism\Prism\Exceptions\PrismProviderOverloadedException;
use Prism\Prism\Exceptions\PrismRateLimitedException;
use Prism\Prism\Facades\Prism;
use ReflectionClass;
use RuntimeException;

/**
 * Requires the using class to implement {@see Agent}.
 */
trait Promptable
{
    protected ?Schema $schema = null;

    public function withSchema(Schema $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function prompt(string $input): object
    {
        $provider = $this->resolveProvider()->toPrismProvider();
        $model = $this->resolveModel();

        debug('[Promptable] Appel LLM', [
            'agent' => static::class,
            'provider' => $provider->value,
            'model' => $model,
            'structured' => $this->schema instanceof Schema,
            'input_length' => strlen($input),
        ]);

        $result = $this->withRateLimitRetries(function () use ($provider, $model, $input) {
            if ($this->schema instanceof Schema) {
                $response = Prism::structured()
                    ->using($provider, $model)
                    ->withSchema($this->schema)
                    ->withSystemPrompt($this->instructions())
                    ->withPrompt($input)
                    ->asStructured();

                return (object) $response->structured;
            }

            return Prism::text()
                ->using($provider, $model)
                ->withSystemPrompt($this->instructions())
                ->withPrompt($input)
                ->asText();
        });

        debug('[Promptable] Réponse LLM reçue', ['agent' => static::class]);

        return $result;
    }

    protected function withRateLimitRetries(callable $callback): object
    {
        $maxAttempts = max(1, (int) config('ai.max_retry_attempts', 3));
        $delay = max(0, (int) config('ai.retry_delay_seconds', 20));

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                return $callback();
            } catch (PrismRateLimitedException | PrismProviderOverloadedException $e) {
                if ($attempt === $maxAttempts) {
                    error('[Promptable] Échec définitif après rate-limit', [
                        'agent' => static::class,
                        'attempts' => $attempt,
                        'error' => $e->getMessage(),
                    ]);

                    throw $e;
                }

                warning('[Promptable] Rate-limit atteint, nouvelle tentative', [
                    'agent' => static::class,
                    'attempt' => $attempt,
                    'max_attempts' => $maxAttempts,
                    'delay_seconds' => $delay * $attempt,
                ]);

                sleep($delay * $attempt);
            }
        }
    }

    protected function resolveProvider(): Lab
    {
        if ($override = config('ai.provider')) {
            return Lab::from($override);
        }

        $attribute = (new ReflectionClass(static::class))->getAttributes(ProviderAttribute::class)[0]
            ?? throw new RuntimeException(sprintf('%s must declare a #[Provider] attribute.', static::class));

        return $attribute->newInstance()->lab;
    }

    protected function resolveModel(): string
    {
        if ($override = config('ai.model')) {
            return $override;
        }

        $attribute = (new ReflectionClass(static::class))->getAttributes(ModelAttribute::class)[0]
            ?? throw new RuntimeException(sprintf('%s must declare a #[Model] attribute.', static::class));

        return $attribute->newInstance()->model;
    }
}
