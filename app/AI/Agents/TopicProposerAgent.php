<?php

namespace App\AI\Agents;

use App\AI\Agent;
use App\AI\Attributes\Model;
use App\AI\Attributes\Provider;
use App\AI\Lab;
use App\AI\Promptable;

#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
class TopicProposerAgent implements Agent
{
    use Promptable;

    public function instructions(?string $instructions = null): string
    {
        return <<<'PROMPT'
        Tu prépares un sujet d'article pour le blog d'UpDaz, développeur web
        freelance à Bordeaux (applications Laravel sur mesure, e-commerce,
        sites Webflow).

        Tu reçois une <synthese> de l'actualité de la semaine et la liste des
        <articles_publies> du blog (slug, titre, accroche).

        1. Formule le sujet comme un titre d'article de moins de 80
           caractères, qui vise une question réelle d'un client ou d'un
           développeur.
        2. Indique si un article publié traite déjà le même sujet, au point
           qu'un nouvel article le concurrencerait dans Google. Dans ce cas,
           renvoie son slug exact : le sujet servira à mettre à jour cet
           article. Un simple thème commun (par exemple « Laravel ») ne
           suffit pas : il faut la même question ou le même angle.
        PROMPT;
    }
}
