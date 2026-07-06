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

    public function instructions(?string $instructions = null): string
    {
        return $instructions ?? <<<'PROMPT'
        Tu es rédacteur SEO pour un blog technique. À partir d'un
        récapitulatif thématique, écris un article original de
        800-1200 mots : titre accrocheur (< 60 caractères), catch
        phrase (une phrase d'accroche affichée sous le titre, dans le
        prolongement éditorial du titre, sans le répéter), meta
        description (< 155 caractères), slug, structure en H2/H3,
        et 3-5 tags. N'invente jamais de faits ou de chiffres qui ne
        figurent pas dans le récapitulatif fourni.
        Refuse les H2 vagues type « Introduction », « Les avantages », « Conclusion », « Pour aller plus loin ».
        Chaque H2 doit annoncer une action ou un livrable.
        Insère au moins un lien vers une page du site www.updaz.fr dans le contenu de l'article (contenu en accord avec le lien utilisé) : 
        - https://www.updaz.fr/application-web-bordeaux
        - https://www.updaz.fr/sur-mesure/e-commerce-bordeaux
        - https://www.updaz.fr/webflow-bordeaux
        Contraintes pour la rédaction du contenu textuel :
        - Aucune formule type « il est important de noter », « dans un monde où », pas de tirets cadratins
        - Pas de récap en fin de section
        - Si tu cites un outil, donne son nom exact
        PROMPT;
    }
}
