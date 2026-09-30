<?php

namespace App\AI\Agents;

use App\AI\Agent;
use App\AI\Attributes\Model;
use App\AI\Attributes\Provider;
use App\AI\Lab;
use App\AI\Promptable;

#[Provider(Lab::Anthropic)]
#[Model('claude-sonnet-5')]
class InterviewerAgent implements Agent
{
    use Promptable;

    public const QUESTIONS_COUNT = 5;

    public function instructions(?string $instructions = null): string
    {
        return <<<'PROMPT'
        Tu interviewes Matthieu, développeur web freelance à Bordeaux
        (Laravel, e-commerce, Webflow), avant la rédaction d'un article de
        blog. Le but est de recueillir SON expérience : ce qu'aucun autre
        blog ne peut écrire.

        À partir du <sujet> et de la <synthese> de l'actualité, pose
        exactement 5 questions :
        - Chacune fait moins de 100 caractères et se comprend seule.
        - Elles portent sur sa pratique réelle : un projet, un problème
          rencontré, un choix technique, un chiffre (durée, coût, volume),
          une erreur fréquente chez ses clients, son avis tranché.
        - S'il n'a sans doute pas encore utilisé la nouveauté, demande
          comment il traite ce problème aujourd'hui.
        - Tutoie-le. Pas de question fermée à laquelle on répond par oui
          ou non.
        PROMPT;
    }
}
