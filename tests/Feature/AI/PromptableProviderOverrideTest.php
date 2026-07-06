<?php

namespace Tests\Feature\AI;

use App\AI\Agents\ArticleAnalyzerAgent;
use Illuminate\Support\Collection;
use Prism\Prism\Enums\FinishReason;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Prism\Prism\Structured\Response as StructuredResponse;
use Prism\Prism\ValueObjects\Meta;
use Prism\Prism\ValueObjects\Usage;
use Tests\TestCase;

class PromptableProviderOverrideTest extends TestCase
{
    public function testUsesTheAgentAttributesByDefault(): void
    {
        config(['ai.provider' => null, 'ai.model' => null]);

        $fake = Prism::fake([
            new StructuredResponse(
                steps: new Collection(),
                text: '',
                structured: ['theme' => 'x'],
                finishReason: FinishReason::Stop,
                usage: new Usage(1, 1),
                meta: new Meta('fake', 'fake'),
            ),
        ]);

        (new ArticleAnalyzerAgent())
            ->withSchema(new ObjectSchema('analysis', 'x', [new StringSchema('theme', '')]))
            ->prompt('contenu');

        $fake->assertRequest(function (array $requests) {
            $this->assertSame('claude-sonnet-5', $requests[0]->model());
        });
    }

    public function testConfigOverridesTheProviderAndModelForEveryAgent(): void
    {
        config(['ai.provider' => 'ollama', 'ai.model' => 'llama3.2']);

        $fake = Prism::fake([
            new StructuredResponse(
                steps: new Collection(),
                text: '',
                structured: ['theme' => 'x'],
                finishReason: FinishReason::Stop,
                usage: new Usage(1, 1),
                meta: new Meta('fake', 'fake'),
            ),
        ]);

        (new ArticleAnalyzerAgent())
            ->withSchema(new ObjectSchema('analysis', 'x', [new StringSchema('theme', '')]))
            ->prompt('contenu');

        $fake->assertRequest(function (array $requests) {
            $this->assertSame('llama3.2', $requests[0]->model());
        });
    }
}
