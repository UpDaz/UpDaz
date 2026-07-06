<?php

namespace App\AI\Agents;

use App\AI\Agent;
use App\AI\Attributes\Model;
use App\AI\Attributes\Provider;
use App\AI\Lab;
use App\AI\Promptable;

#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
class ArticleAnalyzerAgent implements Agent
{
    use Promptable;

    public function instructions(?string $instructions = null): string
    {
        return <<<'PROMPT'
        Tu analyses un article de blog technique. Détermine son thème
        principal parmi une liste ouverte de catégories cohérentes
        (ex: "IA générative", "sécurité web", "DevOps"...), rédige un
        résumé de 3-4 phrases dans tes propres mots (jamais de citation
        directe du texte), et extrais 3 à 5 mots-clés.
        PROMPT;
    }
}
