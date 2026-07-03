<?php

namespace App\AI;

use App\AI\Attributes\Model as ModelAttribute;
use App\AI\Attributes\Provider as ProviderAttribute;
use Prism\Prism\Contracts\Schema;
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
    }

    protected function resolveProvider(): Lab
    {
        $attribute = (new ReflectionClass(static::class))->getAttributes(ProviderAttribute::class)[0]
            ?? throw new RuntimeException(sprintf('%s must declare a #[Provider] attribute.', static::class));

        return $attribute->newInstance()->lab;
    }

    protected function resolveModel(): string
    {
        $attribute = (new ReflectionClass(static::class))->getAttributes(ModelAttribute::class)[0]
            ?? throw new RuntimeException(sprintf('%s must declare a #[Model] attribute.', static::class));

        return $attribute->newInstance()->model;
    }
}
