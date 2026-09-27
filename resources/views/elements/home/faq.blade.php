@php
    $questions = [
        'Quels services propose Updaz pour la création de site internet à Bordeaux et dans toute la France ?' =>
            'J’accompagne les entreprises dans la création de sites internet performants, que ce soit via Webflow pour des sites modernes, rapides et clé en main, ou via la stack Laravel / TALL (Tailwind, Alpine, Livewire, Laravel) pour des projets web sur mesure. J’interviens aussi sur l’optimisation SEO, la vitesse de chargement et la conversion pour améliorer tes performances digitales.',
        'Quelle est la différence entre un site développé avec Laravel et un site créé avec Webflow ?' =>
            'Un site Laravel/TALL est entièrement sur mesure, idéal pour des applications web ou des fonctionnalités complexes avec un fort impact métier. Un site Webflow est plus rapide à mettre en ligne et convient parfaitement à une entreprise qui veut une présence sur le web avec un site vitrine moderne, responsive et facile à gérer sans compétences techniques.',
        'Est-ce que UpDaz travaille uniquement avec des entreprises à Bordeaux ?' =>
            'Non. Même si je suis basé à Bordeaux, je collabore avec des entreprises dans toute la France grâce aux outils en ligne, ce qui permet une collaboration fluide et de confiance.',
        'Combien de temps faut-il pour créer un site internet professionnel avec Webflow ou Laravel ?' =>
            'Un site vitrine Webflow peut être prêt en 2 à 4 semaines. Un site ou une application web développée sur mesure avec Laravel/TALL demande généralement entre 1 et 3 mois, selon la complexité des fonctionnalités à mettre en place.',
        'Est-ce que tu proposes l’optimisation SEO pour améliorer la visibilité d’un site internet ?' =>
            'Oui. Chaque site est conçu avec les bonnes pratiques SEO (structure, performances, responsive design). Je peux aussi accompagner sur le référencement naturel (Google) pour attirer plus de trafic qualifié.',
        'Est-ce que je peux gérer le contenu de mon site moi-même après sa mise en ligne ?' =>
            'Oui. Avec Webflow, tu peux facilement mettre à jour textes, images et contenus. Avec Laravel, je développe une interface d’administration personnalisée pour que tu puisses gérer ton site internet en toute autonomie en fonction du besoin.',
        'Est-ce que tu proposes un suivi et une maintenance après la création du site internet ?' =>
            'Oui. Je propose des forfaits de maintenance et d’accompagnement : mises à jour techniques, sécurité, évolution de fonctionnalités et optimisation continue pour que ton site reste performant.',
    ];
@endphp

<section id="faq" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-4xl gap-8 mx-auto mb-8 md:gap-16 md:mb-16">
            <div class="flex items-center justify-center gap-8">
                <div class="*:w-12 *:h-auto">
                    @include('elements.icon.question-mark')
                </div>
                <h2>Questions fréquentes</h2>
            </div>
            <div>
                @foreach ($questions as $question => $answer)
                    <x-accordion.item :title="$question">
                        {{ $answer }}
                    </x-accordion.item>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('structured-data')
    @include('elements.schema.faq', ['questions' => $questions])
@endpush
