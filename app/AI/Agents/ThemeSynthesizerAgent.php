<?php

namespace App\AI\Agents;

use App\AI\Agent;
use App\AI\Attributes\Model;
use App\AI\Attributes\Provider;
use App\AI\Lab;
use App\AI\Promptable;

#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
class ThemeSynthesizerAgent implements Agent
{
    use Promptable;

    public function instructions(?string $instructions = null): string
    {
        return <<<'PROMPT'
        Tu reçois plusieurs résumés d'articles traitant du même thème.
        Rédige une synthèse unique en 4-6 phrases qui dégage les points
        communs et les tendances entre ces articles, dans un style
        éditorial fluide, sans jamais citer ou lister les articles un
        par un.
        PROMPT;
    }
}
