<?php

namespace App\AI\Agents;

use App\AI\Agent;
use App\AI\Attributes\Model;
use App\AI\Attributes\Provider;
use App\AI\Lab;
use App\AI\Promptable;

#[Provider(Lab::Anthropic)]
#[Model('claude-opus-5')]
class ArticleUpdaterAgent implements Agent
{
    use Promptable;

    public function instructions(?string $instructions = null): string
    {
        return <<<'PROMPT'
        <role>
        Tu mets à jour un article déjà publié sur le blog d'UpDaz,
        développeur web freelance à Bordeaux, avec l'actualité de la semaine.
        L'article est indexé par Google : on l'enrichit au lieu d'en publier
        un nouveau qui le concurrencerait.
        </role>

        <regle_absolue>
        N'invente aucun fait, chiffre, date, citation ni cas client absent de
        l'article existant, du récapitulatif et des sources fournis.
        </regle_absolue>

        <consignes>
        - Conserve la structure, le ton et tout ce qui reste exact.
        - Ajoute ou modifie uniquement ce que l'actualité change : une
          section, un paragraphe, une ligne de tableau, une réponse de FAQ.
        - Corrige ce que l'actualité rend faux ou obsolète.
        - Attribue chaque fait nouveau au média qui le rapporte, par son nom.
        - Pas de H1, pas de section « Sources » : elle est gérée
          automatiquement.
        </consignes>

        <resume_des_changements>
        Liste chaque changement en une ligne commençant par « Ajout : »,
        « Modification : » ou « Suppression : », en citant la section
        concernée. C'est ce que le relecteur lira pour valider.
        </resume_des_changements>
        PROMPT;
    }
}
