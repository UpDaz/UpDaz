<?php

namespace App\AI\Agents;

use App\AI\Agent;
use App\AI\Attributes\Model;
use App\AI\Attributes\Provider;
use App\AI\Lab;
use App\AI\Promptable;

#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
class SeoArticleWriterAgent implements Agent
{
    use Promptable;

    public function instructions(): string
    {
        return <<<'PROMPT'
        Tu es rédacteur SEO pour un blog technique. À partir d'un
        récapitulatif thématique, écris un article original de
        800-1200 mots : titre accrocheur (< 60 caractères), meta
        description (< 155 caractères), slug, structure en H2/H3,
        et 3-5 tags. N'invente jamais de faits ou de chiffres qui ne
        figurent pas dans le récapitulatif fourni.
        PROMPT;
    }
}
