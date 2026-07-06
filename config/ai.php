<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Provider / Model Override
    |--------------------------------------------------------------------------
    |
    | Every AI agent (see app/AI/Agents) declares its own #[Provider] and
    | #[Model] attributes, which are used by default. Setting these values
    | lets an environment (e.g. local) override that default for every
    | agent at once, without touching the agent classes — useful to run
    | against a free local model (Ollama) while production keeps using
    | the provider declared on each agent (Anthropic/Claude).
    |
    */

    'provider' => env('AI_PROVIDER'),

    'model' => env('AI_MODEL'),

    /*
    |--------------------------------------------------------------------------
    | Rate Limit Resilience
    |--------------------------------------------------------------------------
    |
    | Free-tier providers (e.g. Gemini) enforce tight per-minute quotas.
    | When a request is rate-limited or the provider reports itself as
    | overloaded, Promptable retries after a growing delay instead of
    | failing immediately. Jobs that loop over many prompts also pause
    | between each call (see AnalyzeAndGroupArticlesJob) to avoid
    | triggering the limit in the first place.
    |
    */

    'max_retry_attempts' => (int) env('AI_MAX_RETRY_ATTEMPTS', 3),

    'retry_delay_seconds' => (int) env('AI_RETRY_DELAY_SECONDS', 20),

    'throttle_seconds' => (int) env('AI_THROTTLE_SECONDS', 5),

];
