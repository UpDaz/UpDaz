@php
    $questions = [
        'Qu’est-ce que Lunar pour Laravel ?' =>
            'Lunar est un moteur e-commerce conçu pour s’intégrer nativement à Laravel. Il fournit une base technique complète pour gérer produits, commandes, stocks, variations et pricing, tout en laissant une liberté totale dans la structure du code et la logique métier.',
        'Pourquoi choisir Lunar plutôt que Prestashop ou Shopify ?' =>
            'Lunar évite les limites des plateformes préconstruites : aucune dépendance à des modules lourds, pas de contraintes d’abonnement ou de commissions, et aucune structure figée. Il offre un environnement totalement personnalisable, idéal pour les projets e-commerce nécessitant des fonctionnalités spécifiques ou une logique avancée.',
        'Lunar permet-il de créer des catalogues complexes ?' =>
            'Lunar gère nativement les variantes, les attributs personnalisés, les logiques de prix conditionnelles et les catalogues multi-canaux. Il s’adapte aux bases produits atypiques et aux structures complexes que les CMS classiques ont du mal à supporter.',
        'Lunar est-il adapté aux fortes charges ?' =>
            'Grâce à l’écosystème Laravel, Lunar bénéficie d’un environnement optimisé pour la performance : cache, files de traitement, optimisation serveur et séparation des processus. Cette architecture permet d’absorber des volumes importants de trafic et de commandes.',
        'Peut-on intégrer Lunar à un ERP, un CRM ou des services externes ?' =>
            'Lunar repose sur les standards Laravel, ce qui facilite les connexions API, webhooks, synchronisations programmées et intégrations sur mesure. Il s’intègre efficacement à des outils internes ou à des solutions tierces.',
        'Lunar propose-t-il un tableau d’administration ?' =>
            'Lunar inclut une interface d’administration dédiée permettant de gérer le catalogue produits, les stocks, les commandes, les clients et les paramètres du site. Cette interface simplifie la gestion opérationnelle sans limiter les possibilités de développement.',
        'Lunar gère-t-il les paiements et les taxes ?' =>
            'Lunar propose des intégrations natives avec Stripe et d’autres passerelles de paiement, ainsi qu’un système flexible pour définir les règles fiscales et les logiques de pricing. Il s’adapte aux configurations commerciales simples ou avancées.',
        'Comment se déroule un projet e-commerce avec Lunar ?' =>
            'Un projet démarre par la définition du modèle de données et du catalogue, suivie du développement du front-end, de l’intégration des services externes et de la configuration des workflows métier. Le processus se termine par les tests et le déploiement.',
        'Quels sont les coûts liés à l’utilisation de Lunar ?' =>
            'Lunar ne nécessite aucun abonnement propriétaire. Les coûts concernent uniquement le développement sur mesure, l’hébergement et les services externes choisis pour le paiement ou la gestion des données.',
        'Peut-on migrer un site e-commerce existant vers Lunar ?' =>
            'La migration est possible en reprenant le catalogue, les clients et les commandes, puis en reconstruisant les flux métier et les intégrations. Lunar permet de repartir sur une base technique moderne tout en conservant les données essentielles.',
    ];
@endphp

<section id="faq" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-4xl gap-8 mx-auto mb-8 md:gap-16 md:mb-16">
            <div class="flex items-center justify-center gap-8">
                <div class="*:w-12 *:h-auto">
                    @include('elements.icon.question-mark')
                </div>
                <h2>Questions fréquentes sur la création de site e-commerce</h2>
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
