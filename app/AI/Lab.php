<?php

namespace App\AI;

use Prism\Prism\Enums\Provider as PrismProvider;

enum Lab: string
{
    case Anthropic = 'anthropic';
    case OpenAI = 'openai';
    case Mistral = 'mistral';
    case Groq = 'groq';
    case XAI = 'xai';
    case Gemini = 'gemini';
    case Ollama = 'ollama';
    case DeepSeek = 'deepseek';
    case OpenRouter = 'openrouter';
    case Perplexity = 'perplexity';

    public function toPrismProvider(): PrismProvider
    {
        return PrismProvider::from($this->value);
    }
}
