@php
    $questions = [
        'Qu’est-ce qu’une application web sur-mesure développée avec Laravel ?' =>
            'Une application conçue spécifiquement pour un besoin métier précis, construite avec le framework Laravel : architecture personnalisée, logique métier dédiée, performances et évolutivité maîtrisées.',
        'Pourquoi choisir Laravel pour créer une application web professionnelle ?' =>
            'Laravel est un framework structuré, sécurisé et maintenable. Il intègre des outils pour les API, les files d’attente, les tests automatisés, l’authentification et la gestion des données. C’est un standard reconnu, ce qui facilite la reprise du projet à long terme.',
        'Quels types d’applications peut-on développer avec Laravel ?' =>
            'Portails métier, CRM, ERP légers, plateformes collaboratives, extranets, outils internes, API, back-offices pour applications mobiles, systèmes de réservation ou outils de gestion.',
        'Quels sont les avantages d’une application web sur-mesure par rapport à un outil SaaS ?' =>
            'Aucun verrou fonctionnel, pas de limite d’usage, propriété totale du code, intégrations libres, pas d’abonnements cumulés par utilisateur, et des évolutions sans contraintes imposées par un éditeur tiers.',
        'Pouvez-vous reprendre une application Laravel existante ?' =>
            'Oui. Je commence par un audit du code, des dépendances et de l’hébergement, puis je propose un plan d’action priorisé : corrections de sécurité, montée de version de Laravel et de PHP, ajout de tests sur les parcours critiques, puis maintenance et évolutions.',
        'Comment se déroule un projet de développement d’application web avec Laravel ?' =>
            'Analyse du besoin, définition de l’architecture, conception des interfaces, développement des fonctionnalités, tests, déploiement, puis suivi après la mise en ligne. Le projet avance par itérations validées avec vous.',
        'Laravel est-il adapté pour des projets complexes et évolutifs ?' =>
            'Oui. Son écosystème (files d’attente, événements, tâches planifiées, cache) permet d’absorber la complexité, d’ajouter des fonctionnalités progressivement et de garder un code propre malgré la croissance du projet.',
        'Quels sont les coûts à prévoir pour développer une application web sur-mesure en Laravel ?' =>
            'Le coût dépend du périmètre fonctionnel, du nombre d’écrans, des intégrations externes et des contraintes de sécurité. Il comprend un investissement initial, puis éventuellement une maintenance évolutive.',
        'Comment assurer la sécurité d’une application web Laravel ?' =>
            'Protections natives contre les failles CSRF et les injections SQL, hachage des mots de passe, validation stricte des données, gestion des permissions, journalisation, surveillance du serveur et mises à jour régulières.',
        'Une application Laravel peut-elle s’intégrer à des services externes ?' =>
            'Oui. API REST, GraphQL, webhooks, passerelles de paiement, CRM, ERP ou services tiers : Laravel propose une structure adaptée aux échanges entre systèmes.',
        'Combien de temps faut-il pour concevoir et déployer une application web sur-mesure avec Laravel ?' =>
            'Cela dépend de la complexité : quelques semaines pour un outil simple, plusieurs mois pour une plateforme complète. Le rythme dépend aussi du périmètre et de la cadence des décisions.',
        'Travaillez-vous uniquement avec des entreprises à Bordeaux ?' =>
            'Non. Je suis basé à Bordeaux et je rencontre volontiers les entreprises de Gironde, mais je travaille aussi à distance avec des clients dans toute la France.',
    ];
@endphp

<section id="faq" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-4xl gap-8 mx-auto mb-8 md:gap-16 md:mb-16">
            <div class="flex flex-col-reverse items-center justify-center gap-8 md:flex-row">
                <h2 class="text-3xl text-center sm:text-4xl">Questions fréquentes sur le développement Laravel</h2>
                <div class="w-16">
                    @include('elements.icon.question-mark')
                </div>
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
